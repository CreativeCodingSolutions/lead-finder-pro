<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadCaptureController extends Controller
{
    /**
     * LFP Pipeline Template Landing Page
     */
    public function pipelineTemplate()
    {
        return view('lead-magnets.pipeline-template');
    }

    /**
     * Process LFP Lead Magnet email capture
     */
    public function captureLfpEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:150',
        ]);

        $this->storeLead([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? '',
            'company' => $validated['company'] ?? '',
            'source' => 'lfp_pipeline_template',
            'magnet' => 'pipeline_excel_template',
            'created_at' => now()->toDateString(),
        ]);

        Log::info('LFP lead captured', ['email' => $validated['email']]);

        return redirect()->route('lead-magnets.lfp.thanks');
    }

    /**
     * LFP Thank You page
     */
    public function thanks()
    {
        return view('lead-magnets.lfp-thanks');
    }

    private function storeLead(array $data)
    {
        $leadsFile = storage_path('leads/lfp_leads.json');
        $dir = dirname($leadsFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $existing = [];
        if (file_exists($leadsFile)) {
            $content = file_get_contents($leadsFile);
            $existing = json_decode($content, true) ?: [];
        }

        foreach ($existing as $lead) {
            if (strtolower($lead['email'] ?? '') === strtolower($data['email'])) {
                return;
            }
        }

        $existing[] = $data;
        file_put_contents($leadsFile, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }
}
