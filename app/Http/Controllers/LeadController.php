<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Search;
use App\Services\OverpassLeadFinderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::where('user_id', Auth::id())->with('industry');

        // Filters
        if ($request->boolean('with_website')) {
            $query->where('has_website', true);
        }
        if ($request->boolean('with_email')) {
            $query->where('has_email', true);
        }
        if ($request->boolean('with_phone')) {
            $query->where('has_phone', true);
        }
        if ($request->boolean('validated')) {
            $query->where('website_valid', true);
        }
        if ($request->filled('industry_id')) {
            $query->where('industry_id', $request->industry_id);
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->orderByDesc('created_at')->paginate(50);
        $industries = \App\Models\Industry::where('is_active', true)->orderBy('name')->get();

        return view('leads.index', compact('leads', 'industries'));
    }

    public function export(Request $request)
    {
        $query = Lead::where('user_id', Auth::id())->with('industry');

        // Apply same filters as index
        if ($request->boolean('with_website')) $query->where('has_website', true);
        if ($request->boolean('with_email')) $query->where('has_email', true);
        if ($request->boolean('with_phone')) $query->where('has_phone', true);
        if ($request->boolean('validated')) $query->where('website_valid', true);
        if ($request->filled('industry_id')) $query->where('industry_id', $request->industry_id);
        if ($request->filled('city')) $query->where('city', 'like', '%' . $request->city . '%');

        $leads = $query->get();

        $filename = 'leads_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($leads) {
            $f = fopen('php://output', 'w');
            fprintf($f, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM for Excel
            fputcsv($f, Lead::csvHeader(), ';');
            foreach ($leads as $lead) {
                fputcsv($f, $lead->toCsvRow(), ';');
            }
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function validateWebsite(Lead $lead)
    {
        $this->authorize('update', $lead);

        $finder = new OverpassLeadFinderService();
        $isValid = $finder->validateWebsite($lead->website);

        $lead->update(['website_valid' => $isValid]);

        return response()->json([
            'valid' => $isValid,
            'message' => $isValid ? 'Website erreichbar' : 'Website nicht erreichbar',
        ]);
    }

    public function validateAll(Request $request)
    {
        $leads = Lead::where('user_id', Auth::id())
            ->where('has_website', true)
            ->whereNull('website_valid')
            ->limit(20)
            ->get();

        $finder = new OverpassLeadFinderService();
        $validated = 0;

        foreach ($leads as $lead) {
            $isValid = $finder->validateWebsite($lead->website);
            $lead->update(['website_valid' => $isValid]);
            $validated++;
            usleep(200000); // 200ms delay to be nice to servers
        }

        return response()->json([
            'validated' => $validated,
            "message" => "{$validated} Websites geprüft",
        ]);
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $this->authorize('update', $lead);

        $validated = $request->validate([
            'status' => 'required|in:new,contacted,interested,converted,archived',
        ]);

        $lead->update(['status' => $validated['status']]);

        return response()->json(['success' => true]);
    }

    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);
        $lead->delete();
        return response()->json(['success' => true]);
    }
}
