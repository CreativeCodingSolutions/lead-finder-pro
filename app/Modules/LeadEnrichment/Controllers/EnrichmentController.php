<?php

namespace App\Modules\LeadEnrichment\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrichmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $leads = Lead::where('user_id', $user->id)
            ->whereNull('enriched_at')
            ->latest()
            ->paginate(20);

        return view('modules.lead-enrichment.index', compact('leads'));
    }

    public function enrich(Lead $lead)
    {
        $this->authorize('update', $lead);

        // Simulated enrichment - in production, this would call external APIs
        $lead->update([
            'phone' => $lead->phone ?? '+49 30 ' . rand(1000000, 9999999),
            'email' => $lead->email ?? 'info@' . parse_url($lead->website ?? 'example.com', PHP_URL_HOST),
            'address' => $lead->address ?? 'Berlin, Germany',            'enriched_at' => now(),
        ]);

        return back()->with('success', "Lead enriched: {$lead->company_name}");
    }

    public function enrichAll()
    {
        $user = Auth::user();
        $leads = Lead::where('user_id', $user->id)->whereNull('enriched_at')->get();
        $count = 0;

        foreach ($leads as $lead) {
            $lead->update([
                'phone' => $lead->phone ?? '+49 30 ' . rand(1000000, 9999999),
                'email' => $lead->email ?? 'info@' . parse_url($lead->website ?? 'example.com', PHP_URL_HOST),
                'address' => $lead->address ?? 'Berlin, Germany',                'enriched_at' => now(),
            ]);
            $count++;
        }

        return back()->with("success", "$count leads enriched!");
    }
}
