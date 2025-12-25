<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\DesignRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:design_requests,request_id|unique:reviews,request_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240'
        ]);

        // Check if request is approved or completed
        $designRequest = DesignRequest::findOrFail($validated['request_id']);
        if (!in_array($designRequest->status, ['approved', 'completed'])) {
            return response()->json(['message' => 'Chỉ có thể đánh giá khi dự án đã được duyệt hoặc hoàn thành'], 400);
        }

        // Check if customer owns this request
        if ($designRequest->customer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Handle image upload if provided
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('review-images', $fileName, 'public');
            $imageUrl = \Illuminate\Support\Facades\Storage::url($filePath);
        }

        $review = Review::create([
            'review_id' => Str::uuid(),
            'request_id' => $validated['request_id'],
            'customer_id' => $request->user()->user_id,
            'designer_id' => $designRequest->designer_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
            'image_url' => $imageUrl
        ]);

        // Update designer's average rating
        $this->updateDesignerRating($designRequest->designer_id);

        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = Review::with(['request', 'customer', 'designer'])->findOrFail($id);
        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Check if customer owns this review
        if ($review->customer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Check if within 7 days
        $daysSinceCreated = now()->diffInDays($review->created_at);
        if ($daysSinceCreated > 7) {
            return response()->json(['message' => 'Không thể chỉnh sửa đánh giá sau 7 ngày'], 400);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240'
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($review->image_url) {
                $oldPath = str_replace('/storage/', '', $review->image_url);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('review-images', $fileName, 'public');
            $validated['image_url'] = \Illuminate\Support\Facades\Storage::url($filePath);
        }

        $review->update($validated);

        // Update designer's average rating
        $this->updateDesignerRating($review->designer_id);

        return response()->json($review);
    }

    /**
     * Get all reviews for a designer with statistics
     */
    public function getDesignerReviews(Request $request)
    {
        $designerId = $request->user()->user_id;
        
        $reviews = Review::with(['request', 'customer'])
            ->where('designer_id', $designerId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate statistics
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('rating') ?? 0;
        $ratingDistribution = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        // Ensure image URLs are full URLs
        foreach ($reviews as $review) {
            if ($review->image_url && !filter_var($review->image_url, FILTER_VALIDATE_URL)) {
                $review->image_url = url($review->image_url);
            }
        }

        return response()->json([
            'data' => $reviews,
            'statistics' => [
                'total_reviews' => $totalReviews,
                'average_rating' => round($averageRating, 2),
                'rating_distribution' => $ratingDistribution
            ]
        ]);
    }

    /**
     * Get review by request ID (for checking if review exists)
     */
    public function getByRequest($requestId)
    {
        $review = Review::with(['request', 'customer', 'designer'])
            ->where('request_id', $requestId)
            ->first();

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Ensure image URL is full URL
        if ($review->image_url && !filter_var($review->image_url, FILTER_VALIDATE_URL)) {
            $review->image_url = url($review->image_url);
        }

        return response()->json($review);
    }

    private function updateDesignerRating($designerId)
    {
        $avgRating = Review::where('designer_id', $designerId)->avg('rating');
        // You can store this in a separate table or cache it
        // For now, we'll just calculate it on the fly
    }
}

