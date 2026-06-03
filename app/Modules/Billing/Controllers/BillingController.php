<?php

namespace App\Modules\Billing\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $subscription = [
            'plan' => $user->stripe_plan ?? 'Free',
            'status' => $user->subscription_status ?? 'active',
            'renews_at' => $user->renews_at ?? now()->addMonth()->format('Y-m-d'),
            'used_credits' => $user->used_credits ?? 0,
            'total_credits' => $user->total_credits ?? 100,
        ];

        return view('billing.index', compact('subscription'));
    }

    public function invoices(Request $request)
    {
        $user = $request->user();

        $invoices = [
            [
                'id' => 'inv_001',
                'date' => now()->subDays(30)->format('Y-m-d'),
                'amount' => '29.00',
                'currency' => 'EUR',
                'status' => 'paid',
            ],
            [
                'id' => 'inv_002',
                'date' => now()->subDays(60)->format('Y-m-d'),
                'amount' => '29.00',
                'currency' => 'EUR',
                'status' => 'paid',
            ],
        ];

        return view('billing.invoices', compact('invoices'));
    }

    public function download(Request $request, $id)
    {
        // Placeholder: In production, generate PDF via DomPDF or similar
        return response()->json([
            'message' => "Invoice {$id} download placeholder",
            'note' => 'PDF generation requires dompdf/dompdf package',
        ]);
    }
}
