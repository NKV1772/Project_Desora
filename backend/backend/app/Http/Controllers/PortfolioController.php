<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role === 'Designer') {
            $portfolios = Portfolio::where('designer_id', $request->user()->user_id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $portfolios = Portfolio::where('is_approved', true)
                ->with(['designer'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }

        return response()->json(['data' => $portfolios]);
    }

    public function publicIndex(Request $request)
    {
        $query = Portfolio::where('is_approved', true)
            ->with(['designer']);

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json($query->orderBy('created_at', 'desc')->paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:51200',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'tags' => 'nullable|array'
        ]);

        $file = $request->file('image');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('portfolios', $fileName, 'public');

        $portfolio = Portfolio::create([
            'portfolio_id' => Str::uuid(),
            'designer_id' => $request->user()->user_id,
            'title' => $validated['title'],
            'image_url' => Storage::url($filePath),
            'category' => $validated['category'] ?? null,
            'description' => $validated['description'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'is_approved' => false
        ]);

        return response()->json($portfolio, 201);
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->designer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'tags' => 'nullable|array'
        ]);

        $portfolio->update($validated);

        return response()->json($portfolio);
    }

    public function destroy(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->designer_id !== $request->user()->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $portfolio->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function approve(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->is_approved = true;
        $portfolio->save();

        return response()->json($portfolio);
    }
}

