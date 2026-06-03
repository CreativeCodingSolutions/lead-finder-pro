<?php

namespace App\Modules\Analytics\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Search;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Leads over time (last 30 days)
        $leadsOverTime = Lead::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Search success rate
        $totalSearches = Search::where('user_id', $userId)->count();
        $searchesWithResults = Search::where('user_id', $userId)->where('results_count', '>', 0)->count();
        $successRate = $totalSearches > 0 ? round(($searchesWithResults / $totalSearches) * 100) : 0;

        // Top industries
        $topIndustries = Search::where('user_id', $userId)
            ->selectRaw('industry, COUNT(*) as count')
            ->groupBy('industry')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Lead quality distribution
        $withWebsite = Lead::where('user_id', $userId)->where('has_website', true)->count();
        $withEmail = Lead::where('user_id', $userId)->where('has_email', true)->count();
        $validated = Lead::where('user_id', $userId)->where('website_valid', true)->count();
        $total = Lead::where('user_id', $userId)->count();

        return view('modules.analytics.index', compact(
            'leadsOverTime', 'successRate', 'topIndustries',
            'withWebsite', 'withEmail', 'validated', 'total', 'totalSearches'
        ));
    }
}
