<?php

namespace App\Http\Controllers;

use App\Models\DraftVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    public function index(Request $request)
    {
        $drafts = DraftVersion::with(['request', 'feedbacks'])
            ->whereHas('request', function($q) use ($request) {
                $q->where('designer_id', $request->user()->user_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $drafts]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:design_requests,request_id',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,psd,ai|max:51200'
        ]);

        $file = $request->file('file');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('drafts', $fileName, 'public');

        // Get next version number
        $lastVersion = DraftVersion::where('request_id', $validated['request_id'])
            ->orderBy('version_number', 'desc')
            ->first();
        $versionNumber = $lastVersion ? $lastVersion->version_number + 1 : 1;

        // Generate file URL - Storage::url() returns /storage/path
        $fileUrl = Storage::url($filePath);
        // Ensure it starts with /storage/
        if (!str_starts_with($fileUrl, '/storage/')) {
            $fileUrl = '/storage/' . ltrim($fileUrl, '/');
        }
        
        $draft = DraftVersion::create([
            'draft_id' => Str::uuid(),
            'request_id' => $validated['request_id'],
            'version_number' => $versionNumber,
            'file_url' => $fileUrl,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'description' => $validated['description'] ?? null,
            'status' => 'Pending'
        ]);
        
        \Log::info('Draft created:', [
            'draft_id' => $draft->draft_id,
            'file_url' => $draft->file_url,
            'file_path' => $filePath
        ]);

        // Update request status
        $designRequest = \App\Models\DesignRequest::find($validated['request_id']);
        if ($designRequest) {
            $designRequest->status = 'waiting_feedback';
            $designRequest->save();
        }

        return response()->json($draft, 201);
    }

    public function show(Request $request, $id)
    {
        try {
            $draft = DraftVersion::with(['request', 'feedbacks.customer'])
                ->where('draft_id', $id)
                ->firstOrFail();
            
            // Permission check: Customer can only view drafts for their requests
            // Designer can view drafts for requests they're assigned to
            $user = $request->user();
            if ($user->role === 'Customer') {
                if ($draft->request->customer_id !== $user->user_id) {
                    return response()->json([
                        'message' => 'Bạn không có quyền xem bản nháp này'
                    ], 403);
                }
            } elseif ($user->role === 'Designer') {
                if ($draft->request->designer_id !== $user->user_id) {
                    return response()->json([
                        'message' => 'Bạn không có quyền xem bản nháp này'
                    ], 403);
                }
            }
            
            // Ensure file_url is a full URL if it's a relative path
            if ($draft->file_url) {
                // If it's already a full URL, keep it
                if (filter_var($draft->file_url, FILTER_VALIDATE_URL)) {
                    // Already a full URL
                } elseif (str_starts_with($draft->file_url, '/storage/')) {
                    // Relative path starting with /storage/
                    $draft->file_url = url($draft->file_url);
                } elseif (str_starts_with($draft->file_url, 'storage/')) {
                    // Relative path starting with storage/
                    $draft->file_url = url('/' . $draft->file_url);
                } else {
                    // Try to construct full URL
                    $draft->file_url = url('/storage/' . $draft->file_url);
                }
                
                \Log::info('Draft file URL:', [
                    'original' => $draft->getOriginal('file_url'),
                    'final' => $draft->file_url
                ]);
            }
            
            return response()->json($draft);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Draft not found: ' . $id);
            return response()->json([
                'message' => 'Không tìm thấy bản nháp'
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Error fetching draft: ' . $e->getMessage(), [
                'draft_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Không thể tải bản nháp',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByRequest($requestId)
    {
        $drafts = DraftVersion::with(['feedbacks'])
            ->where('request_id', $requestId)
            ->orderBy('version_number', 'desc')
            ->get();

        return response()->json(['data' => $drafts]);
    }
}

