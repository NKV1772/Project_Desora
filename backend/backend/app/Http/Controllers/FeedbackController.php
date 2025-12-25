<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function index(Request $request, $draftId)
    {
        try {
            // Verify draft exists
            $draft = \App\Models\DraftVersion::with('request')->where('draft_id', $draftId)->first();
            if (!$draft) {
                return response()->json([
                    'message' => 'Không tìm thấy bản nháp',
                    'data' => []
                ], 404);
            }

            // Permission check: Customer can only view feedbacks for their requests
            // Designer can view feedbacks for drafts of requests they're assigned to
            $user = $request->user();
            if ($user->role === 'Customer') {
                if ($draft->request && $draft->request->customer_id !== $user->user_id) {
                    return response()->json([
                        'message' => 'Bạn không có quyền xem phản hồi này'
                    ], 403);
                }
            } elseif ($user->role === 'Designer') {
                if ($draft->request && $draft->request->designer_id !== $user->user_id) {
                    return response()->json([
                        'message' => 'Bạn không có quyền xem phản hồi này'
                    ], 403);
                }
            }

            $feedbacks = Feedback::with(['customer'])
                ->where('draft_id', $draftId)
                ->orderBy('created_at', 'desc')
                ->get();

            // Ensure attachment URLs are full URLs
            foreach ($feedbacks as $feedback) {
                if ($feedback->attachment_url && !filter_var($feedback->attachment_url, FILTER_VALIDATE_URL)) {
                    $feedback->attachment_url = url($feedback->attachment_url);
                }
            }

            return response()->json(['data' => $feedbacks]);
        } catch (\Exception $e) {
            \Log::error('Error fetching feedbacks: ' . $e->getMessage(), [
                'draft_id' => $draftId,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Không thể tải phản hồi',
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $draftId)
    {
        try {
            // Validate input - handle both JSON and FormData
            $validated = $request->validate([
                'comment' => 'nullable|string',
                'is_approved' => 'nullable|boolean',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,psd,ai,zip|max:51200'
            ]);

            // Convert string "1"/"0" to boolean if needed (from FormData)
            if (isset($validated['is_approved'])) {
                if (is_string($validated['is_approved'])) {
                    $validated['is_approved'] = in_array(strtolower($validated['is_approved']), ['1', 'true', 'yes']);
                }
            } else {
                $validated['is_approved'] = false;
            }

            // Verify draft exists and user has permission
            $draft = \App\Models\DraftVersion::with('request')->where('draft_id', $draftId)->firstOrFail();
            
            // Permission check: Only customer who owns the request can submit feedback
            $user = $request->user();
            if ($user->role !== 'Customer') {
                return response()->json([
                    'message' => 'Chỉ khách hàng mới có thể gửi phản hồi'
                ], 403);
            }
            
            if ($draft->request && $draft->request->customer_id !== $user->user_id) {
                return response()->json([
                    'message' => 'Bạn không có quyền gửi phản hồi cho bản nháp này'
                ], 403);
            }

        // Handle file attachment if provided
        $attachmentUrl = null;
        $attachmentName = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('feedback-attachments', $fileName, 'public');
            $attachmentUrl = \Illuminate\Support\Facades\Storage::url($filePath);
            $attachmentName = $file->getClientOriginalName();
        }

        $feedback = Feedback::create([
            'feedback_id' => Str::uuid(),
            'draft_id' => $draftId,
            'customer_id' => $request->user()->user_id,
            'comment' => $validated['comment'] ?? null,
            'is_approved' => $validated['is_approved'] ?? false,
            'is_read' => false,
            'attachment_url' => $attachmentUrl,
            'attachment_name' => $attachmentName
        ]);

        // Update draft status if approved
        if ($validated['is_approved'] ?? false) {
            $draft->status = 'Approved';
            $draft->approved_at = now();
            $draft->save();

            // Update request status to completed when customer approves draft
            // This marks the project as fully completed
            $designRequest = $draft->request;
            if ($designRequest) {
                $designRequest->status = 'completed';
                $designRequest->save();
            }
        } else {
            // If requesting changes, update request status to in_progress
            $designRequest = $draft->request;
            if ($designRequest && $designRequest->status === 'waiting_feedback') {
                $designRequest->status = 'in_progress';
                $designRequest->save();
            }
        }

            return response()->json($feedback, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error when submitting feedback:', [
                'draft_id' => $draftId,
                'errors' => $e->errors()
            ]);
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Draft not found when submitting feedback: ' . $draftId);
            return response()->json([
                'message' => 'Không tìm thấy bản nháp'
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Error submitting feedback: ' . $e->getMessage(), [
                'draft_id' => $draftId,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Không thể gửi phản hồi. Vui lòng thử lại.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}

