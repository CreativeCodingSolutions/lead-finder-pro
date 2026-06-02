<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'city' => 'required|string|max:100',
            'country' => 'required|string|size:2',
        ]);

        $search = Search::create([
            'user_id' => Auth::id(),
            'industry_id' => $validated['industry_id'],
            'city' => $validated['city'],
            'country' => strtoupper($validated['country']),
            'status' => 'pending',
        ]);

        return response()->json($search, 201);
    }

    public function results(Search $search)
    {
        $this->authorize('view', $search);
        return response()->json($search->leads()->with('industry')->paginate(50));
    }
}
