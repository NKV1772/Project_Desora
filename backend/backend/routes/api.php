<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Requests - Specific routes must come before parameterized routes
    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/my', [RequestController::class, 'myRequests']);
    Route::post('/requests', [RequestController::class, 'store']);

    // Customer routes - Must be before /requests/{id} to avoid route conflict
    Route::middleware('role:Customer')->group(function () {
        Route::get('/requests/reviewable', [RequestController::class, 'reviewableRequests']);
        Route::post('/quotes/{id}/accept', [QuoteController::class, 'accept']);
        Route::post('/quotes/{id}/reject', [QuoteController::class, 'reject']);
        Route::post('/drafts/{id}/feedback', [FeedbackController::class, 'store']);
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::get('/reviews/request/{requestId}', [ReviewController::class, 'getByRequest']);
        Route::get('/reviews/{id}', [ReviewController::class, 'show']);
        Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    });

    // Designer routes - Must be before /requests/{id} to avoid route conflict
    Route::middleware('role:Designer')->group(function () {
        Route::get('/requests/designer', [RequestController::class, 'designerRequests']);
        Route::post('/quotes', [QuoteController::class, 'store']);
        Route::get('/quotes/{id}', [QuoteController::class, 'show']);
        Route::post('/drafts', [DraftController::class, 'store']);
        Route::get('/drafts', [DraftController::class, 'index']);
        Route::get('/reviews/designer', [ReviewController::class, 'getDesignerReviews']);
        Route::get('/portfolios', [PortfolioController::class, 'index']);
        Route::post('/portfolios', [PortfolioController::class, 'store']);
        Route::put('/portfolios/{id}', [PortfolioController::class, 'update']);
        Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy']);
    });

    // Drafts - accessible by both Customer and Designer
    Route::get('/drafts/{id}', [DraftController::class, 'show']);

    // Requests - Parameterized routes must come after specific routes
    Route::get('/requests/{id}', [RequestController::class, 'show']);
    Route::put('/requests/{id}/status', [RequestController::class, 'updateStatus']);

    // Drafts & Feedback (both roles)
    Route::get('/drafts/request/{requestId}', [DraftController::class, 'getByRequest']);
    Route::get('/drafts/{id}/feedback', [FeedbackController::class, 'index']);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    // Admin routes
    Route::middleware('role:Admin')->group(function () {
        Route::get('/admin/users', [UserController::class, 'index']);
        Route::put('/admin/users/{id}', [UserController::class, 'update']);
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
        Route::post('/admin/portfolios/{id}/approve', [PortfolioController::class, 'approve']);
    });
});

// Public portfolio viewing
Route::get('/public/portfolios', [PortfolioController::class, 'publicIndex']);
