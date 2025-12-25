<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|exists:design_requests,request_id',
            'price' => 'required|numeric|min:100000',
            'estimated_days' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $validated['quote_id'] = Str::uuid();
        $validated['designer_id'] = $request->user()->user_id;
        $validated['status'] = 'Pending';

        $quote = Quote::create($validated);

        // Update request status
        $designRequest = \App\Models\DesignRequest::find($validated['request_id']);
        if ($designRequest) {
            $designRequest->status = 'quote_sent';
            $designRequest->designer_id = $request->user()->user_id;
            $designRequest->save();
        }

        return response()->json($quote, 201);
    }

    public function show($id)
    {
        $quote = Quote::with(['request', 'designer'])->findOrFail($id);
        return response()->json($quote);
    }

    public function accept(Request $request, $id)
    {
        $quote = Quote::with('request')->findOrFail($id);
        
        // Check if customer owns the request
        if ($quote->request->customer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update quote status
        $quote->status = 'Accepted';
        $quote->save();

        // Update request status
        $designRequest = $quote->request;
        $designRequest->status = 'quote_accepted';
        $designRequest->save();

        return response()->json($quote);
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'rejection_reason' => 'nullable|string|max:1000'
        ]);

        $quote = Quote::with('request')->findOrFail($id);
        
        // Check if customer owns the request
        if ($quote->request->customer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update quote status and rejection reason
        $quote->status = 'Rejected';
        $quote->rejection_reason = $validated['rejection_reason'] ?? null;
        $quote->save();

        // Check if there are other pending quotes
        $hasPendingQuotes = Quote::where('request_id', $quote->request_id)
            ->where('status', 'Pending')
            ->exists();

        // Update request status
        $designRequest = $quote->request;
        if (!$hasPendingQuotes) {
            // If no pending quotes, set back to pending_quote
            $designRequest->status = 'pending_quote';
            $designRequest->designer_id = null;
        }
        $designRequest->save();

        return response()->json($quote);
    }
}

