<?php

namespace App\Http\Controllers;

use App\Models\DesignRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $query = DesignRequest::with(['customer', 'designer']);

        // Filter by role
        if ($request->user()->role === 'Customer') {
            $query->where('customer_id', $request->user()->user_id);
        } elseif ($request->user()->role === 'Designer') {
            $query->where('designer_id', $request->user()->user_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json($query->orderBy('created_at', 'desc')->paginate(15));
    }

    public function myRequests(Request $request)
    {
        $requests = DesignRequest::with(['customer', 'designer'])
            ->where('customer_id', $request->user()->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $requests]);
    }

    public function designerRequests(Request $request)
    {
        $userId = $request->user()->user_id;
        
        // Designer should see:
        // 1. All requests with status 'pending_quote' (not assigned yet)
        // 2. All requests assigned to this designer (regardless of status)
        $query = DesignRequest::with(['customer'])
            ->where(function($q) use ($userId) {
                $q->where('status', 'pending_quote')
                  ->orWhere('designer_id', $userId);
            });

        // Additional status filter if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->orderBy('created_at', 'desc')->get();

        // Debug logging
        \Log::info('Designer Requests Query', [
            'user_id' => $userId,
            'user_role' => $request->user()->role,
            'count' => $requests->count(),
            'requests' => $requests->map(function($r) {
                return [
                    'request_id' => $r->request_id,
                    'title' => $r->title,
                    'status' => $r->status,
                    'designer_id' => $r->designer_id
                ];
            })
        ]);

        return response()->json(['data' => $requests]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:50',
            'category' => 'nullable|string|max:50',
            'budget' => 'nullable|numeric|min:100000',
            'deadline' => 'nullable|date|after:today',
            'reference_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip,rar|max:51200' // Max 50MB per file
        ]);

        $validated['request_id'] = Str::uuid();
        $validated['customer_id'] = $request->user()->user_id;
        $validated['status'] = 'pending_quote';

        // Handle file uploads
        $referenceFiles = [];
        if ($request->hasFile('reference_files')) {
            foreach ($request->file('reference_files') as $file) {
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('reference-files', $fileName, 'public');
                $referenceFiles[] = [
                    'url' => Storage::url($filePath),
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
        }
        $validated['reference_files'] = !empty($referenceFiles) ? json_encode($referenceFiles) : null;

        $designRequest = DesignRequest::create($validated);

        // Convert reference_files back to array for response
        if ($designRequest->reference_files) {
            $designRequest->reference_files = json_decode($designRequest->reference_files, true);
        }

        return response()->json($designRequest, 201);
    }

    public function show($id)
    {
        $request = DesignRequest::with(['customer', 'designer', 'quotes', 'drafts.feedbacks'])
            ->findOrFail($id);

        // Ensure reference_files is returned as array and URLs are full URLs
        if ($request->reference_files) {
            $files = is_string($request->reference_files) 
                ? json_decode($request->reference_files, true) 
                : $request->reference_files;
            
            if (is_array($files)) {
                foreach ($files as &$file) {
                    if (isset($file['url']) && !filter_var($file['url'], FILTER_VALIDATE_URL)) {
                        $file['url'] = url($file['url']);
                    }
                }
                $request->reference_files = $files;
            }
        }

        return response()->json($request);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending_quote,quote_sent,quote_accepted,in_progress,waiting_feedback,approved,completed,cancelled'
        ]);

        $designRequest = DesignRequest::findOrFail($id);
        $designRequest->status = $validated['status'];
        $designRequest->save();

        return response()->json($designRequest);
    }

    public function reviewableRequests(Request $request)
    {
        $customerId = $request->user()->user_id;
        
        // Get requests that are approved or completed
        $requests = DesignRequest::with(['customer', 'designer'])
            ->where('customer_id', $customerId)
            ->whereIn('status', ['approved', 'completed'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get all reviews for these requests
        $requestIds = $requests->pluck('request_id');
        $reviews = \App\Models\Review::whereIn('request_id', $requestIds)
            ->get()
            ->keyBy('request_id');

        // Attach review info to each request and ensure reference_files is parsed
        $requestsWithReviews = $requests->map(function($req) use ($reviews) {
            $review = $reviews->get($req->request_id);
            
            // Parse reference_files safely
            $referenceFiles = $req->reference_files;
            if ($referenceFiles) {
                if (is_string($referenceFiles)) {
                    $referenceFiles = json_decode($referenceFiles, true);
                }
                // Ensure URLs are full URLs
                if (is_array($referenceFiles)) {
                    $referenceFiles = array_map(function($file) {
                        if (isset($file['url']) && !filter_var($file['url'], FILTER_VALIDATE_URL)) {
                            $file['url'] = url($file['url']);
                        }
                        return $file;
                    }, $referenceFiles);
                }
            }
            
            // Create array representation
            return [
                'request_id' => $req->request_id,
                'title' => $req->title,
                'description' => $req->description,
                'status' => $req->status,
                'budget' => $req->budget,
                'category' => $req->category,
                'deadline' => $req->deadline,
                'created_at' => $req->created_at,
                'updated_at' => $req->updated_at,
                'completed_at' => $req->updated_at,
                'reference_files' => $referenceFiles,
                'has_review' => $review !== null,
                'review' => $review ? [
                    'review_id' => $review->review_id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'image_url' => $review->image_url,
                    'created_at' => $review->created_at,
                    'updated_at' => $review->updated_at
                ] : null,
                'customer' => $req->customer ? [
                    'user_id' => $req->customer->user_id,
                    'full_name' => $req->customer->full_name,
                    'email' => $req->customer->email
                ] : null,
                'designer' => $req->designer ? [
                    'user_id' => $req->designer->user_id,
                    'full_name' => $req->designer->full_name,
                    'email' => $req->designer->email
                ] : null
            ];
        });

        \Log::info('Reviewable Requests', [
            'customer_id' => $customerId,
            'total_requests' => $requests->count(),
            'requests_with_reviews' => $reviews->count(),
            'statuses' => $requests->pluck('status')->toArray(),
            'request_ids' => $requests->pluck('request_id')->toArray()
        ]);

        return response()->json(['data' => $requestsWithReviews->values()]);
    }
}

