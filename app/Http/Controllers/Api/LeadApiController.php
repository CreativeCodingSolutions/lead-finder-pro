<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::where('user_id', Auth::id())->with('industry');

        if ($request->filled('city')) $query->where('city', 'like', '%' . $request->city . '%');
        if ($request->filled('industry_id')) $query->where('industry_id', $request->industry_id);
        if ($request->boolean('with_website')) $query->where('has_website', true);
        if ($request->boolean('with_email')) $query->where('has_email', true);

        return response()->json($query->paginate(50));
    }
}
