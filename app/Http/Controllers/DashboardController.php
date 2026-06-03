<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Search;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Get all available modules and their active/inactive status.
     */
    private function getModuleStatuses(): array
    {
        $modules = [];
        $moduleFiles = glob(base_path('app/Modules/*/Module.php'));

        foreach ($moduleFiles as $moduleFile) {
            $moduleName = basename(dirname($moduleFile));
            $config = require $moduleFile;
            $modules[] = [
                'name' => $config['name'] ?? $moduleName,
                'description' => $config['description'] ?? '',
                'version' => $config['version'] ?? '1.0.0',
                'enabled' => $config['enabled'] ?? false,
                'slug' => strtolower(str_replace(' ', '-', $moduleName)),
                'key' => strtolower($moduleName),
            ];
        }

        return $modules;
    }

    public function index()
    {
        $userId = Auth::id();

        $stats = [
            'total_leads' => Lead::where('user_id', $userId)->count(),
            'total_searches' => Search::where('user_id', $userId)->count(),
            'with_website' => Lead::where('user_id', $userId)->where('has_website', true)->count(),
            'with_email' => Lead::where('user_id', $userId)->where('has_email', true)->count(),
            'validated' => Lead::where('user_id', $userId)->where('website_valid', true)->count(),
            'recent_searches' => Search::where('user_id', $userId)->latest()->take(5)->with('industry')->get(),
            'recent_leads' => Lead::where('user_id', $userId)->latest()->take(10)->with('industry')->get(),
        ];

        $modules = $this->getModuleStatuses();

        return view('dashboard', compact('stats', 'modules'));
    }
}
