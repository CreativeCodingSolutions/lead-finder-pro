<?php

namespace App\Modules\ExportEnhanced\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function index()
    {
        return view('modules.export-enhanced.index');
    }

    public function exportCsv(Request $request)
    {
        $user = Auth::user();
        $leads = Lead::where('user_id', $user->id)->with('search')->get();
        $filename = 'leads_' . now()->format('Y-m-d_His') . '.csv';

        $response = new StreamedResponse(function () use ($leads) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Company', 'Website', 'Email', 'Phone', 'Address', 'Industry', 'Valid', 'Source', 'Date']);

            foreach ($leads as $lead) {
                fputcsv($handle, [
                    $lead->company_name,
                    $lead->website,
                    $lead->email,
                    $lead->phone,
                    $lead->address,
                    $lead->search->industry ?? '',
                    $lead->website_valid ? 'Yes' : 'No',
                    $lead->search->query ?? '',
                    $lead->created_at->format('Y-m-d H:i'),
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename=\"$filename\"");
        return $response;
    }

    public function exportJson(Request $request)
    {
        $user = Auth::user();
        $leads = Lead::where('user_id', $user->id)->with('search')->get();
        $filename = 'leads_' . now()->format('Y-m-d_His') . '.json';

        return response()->streamDownload(function () use ($leads) {
            echo $leads->toJson(JSON_PRETTY_PRINT);
        }, $filename, ['Content-Type' => 'application/json']);
    }
}
