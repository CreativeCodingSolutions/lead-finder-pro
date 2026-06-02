<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Lead;
use App\Models\Search;
use App\Services\OverpassLeadFinderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function create()
    {
        $industries = Industry::where('is_active', true)->orderBy('sort_order')->get();
        $searches = Search::where('user_id', Auth::id())->latest()->paginate(10);
        return view('search.create', compact('industries', 'searches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|size:2',
            'radius_km' => 'nullable|integer|min:1|max:100',
            'filter_website' => 'boolean',
            'filter_email' => 'boolean',
            'filter_phone' => 'boolean',
            'filter_name' => 'boolean',
        ]);

        $search = Search::create([
            'user_id' => Auth::id(),
            'industry_id' => $validated['industry_id'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'] ?? null,
            'country' => strtoupper($validated['country']),
            'radius_km' => $validated['radius_km'] ?? 25,
            'filter_website' => $validated['filter_website'] ?? false,
            'filter_email' => $validated['filter_email'] ?? false,
            'filter_phone' => $validated['filter_phone'] ?? false,
            'filter_name' => $validated['filter_name'] ?? true,
            'status' => 'running',
        ]);

        try {
            $industry = Industry::findOrFail($validated['industry_id']);
            $finder = new OverpassLeadFinderService();
            $leadsData = $finder->findLeads($search, $industry);

            // Deduplicate: skip leads with same email or same name+city already in DB
            $existingEmails = Lead::where('user_id', Auth::id())
                ->whereNotNull('email')
                ->pluck('email')
                ->flip()
                ->toArray();

            $inserted = 0;
            $skipped = 0;

            foreach ($leadsData as $leadData) {
                // Skip if email already exists
                if (!empty($leadData['email']) && isset($existingEmails[$leadData['email']])) {
                    $skipped++;
                    continue;
                }

                // Skip if name+city already exists
                $exists = Lead::where('user_id', Auth::id())
                    ->where('name', $leadData['name'])
                    ->where('city', $leadData['city'])
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                Lead::create(array_merge($leadData, [
                    'user_id' => Auth::id(),
                    'search_id' => $search->id,
                    'industry_id' => $industry->id,
                ]));

                if (!empty($leadData['email'])) {
                    $existingEmails[$leadData['email']] = true;
                }
                $inserted++;
            }

            $search->update([
                'status' => 'completed',
                'result_count' => $inserted,
            ]);

            return redirect()->route('search.results', $search)
                ->with('success', "{$inserte} neue Leads gefunden" . ($skipped > 0 ? " ({$skipped} Duplikate übersprungen)" : ''));

        } catch (\Exception $e) {
            $search->update(['status' => 'failed']);
            return back()->with('error', 'Fehler bei der Suche: ' . $e->getMessage());
        }
    }

    public function results(Search $search)
    {
        $this->authorize('view', $search);

        $leads = Lead::where('search_id', $search->id)
            ->with('industry')
            ->orderByDesc('has_website')
            ->orderByDesc('has_email')
            ->paginate(50);

        return view('search.results', compact('search', 'leads'));
    }

    public function destroy(Search $search)
    {
        $this->authorize('delete', $search);
        $search->leads()->delete();
        $search->delete();
        return redirect()->route('search.create')->with('success', 'Suche und Leads gelöscht.');
    }
}
