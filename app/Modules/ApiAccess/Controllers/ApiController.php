<?php

namespace App\Modules\ApiAccess\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    /**
     * Simulated API keys — in production, stored in database.
     */
    private function getKeys(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Production',
                'key' => 'lfp_' . Str::random(12) . '********' . Str::random(4),
                'last_used_at' => now()->subHours(2),
                'created_at' => now()->subDays(14),
                'active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Development',
                'key' => 'lfp_' . Str::random(12) . '********' . Str::random(4),
                'last_used_at' => now()->subDays(3),
                'created_at' => now()->subDays(7),
                'active' => true,
            ],
        ];
    }

    public function index()
    {
        $keys = $this->getKeys();
        $endpoints = [
            ['method' => 'GET', 'path' => '/api/v1/leads', 'description' => 'List all leads'],
            ['method' => 'POST', 'path' => '/api/v1/search', 'description' => 'Create a new search'],
            ['method' => 'GET', 'path' => '/api/v1/search/{id}/results', 'description' => 'Get search results'],
            ['method' => 'GET', 'path' => '/api/v1/leads/export', 'description' => 'Export leads (CSV/JSON)'],
            ['method' => 'GET', 'path' => '/api/v1/analytics', 'description' => 'Get analytics data'],
        ];

        return view('modules.api-access.index', compact('keys', 'endpoints'));
    }

    public function createKey(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // In production: store in database
        // ApiKey::create([...])

        return back()->with('success', 'API-Key wurde erstellt.');
    }

    public function updateKey(Request $request, $keyId)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        // In production: update in database

        return back()->with('success', 'API-Key wurde aktualisiert.');
    }

    public function revokeKey($keyId)
    {
        // In production: delete or deactivate in database

        return back()->with('success', 'API-Key wurde widerrufen.');
    }
}
