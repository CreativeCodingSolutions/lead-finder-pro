<?php

namespace App\Modules\ExportScheduler\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportSchedulerController extends Controller
{
    /**
     * Simulated scheduled exports storage.
     * In production, this would be a database model.
     */
    private function getSchedules(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Weekly Lead Report',
                'frequency' => 'weekly',
                'format' => 'csv',
                'industry' => 'Restaurants',
                'city' => 'Berlin',
                'next_run' => now()->addDays(3)->format('Y-m-d H:i'),
                'last_run' => now()->subDays(4)->format('Y-m-d H:i'),
                'active' => true,
                'created_at' => now()->subDays(14),
            ],
            [
                'id' => 2,
                'name' => 'Monthly Business Export',
                'frequency' => 'monthly',
                'format' => 'json',
                'industry' => 'All',
                'city' => 'All',
                'next_run' => now()->addDays(15)->format('Y-m-d H:i'),
                'last_run' => now()->subDays(15)->format('Y-m-d H:i'),
                'active' => true,
                'created_at' => now()->subDays(30),
            ],
        ];
    }

    /**
     * List all scheduled exports.
     */
    public function index()
    {
        $schedules = $this->getSchedules();
        return view('modules.export-scheduler.index', compact('schedules'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('modules.export-scheduler.create');
    }

    /**
     * Store a new scheduled export.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'frequency' => 'required|in:daily,weekly,monthly',
            'format' => 'required|in:csv,json',
            'industry' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        // In production: save to database
        // ScheduledExport::create([...])

        return redirect()->route('exports.schedule.index')
            ->with('success', 'Export schedule "' . $request->name . '" created successfully!');
    }

    /**
     * Delete a scheduled export.
     */
    public function destroy($id)
    {
        // In production: delete from database
        // ScheduledExport::findOrFail($id)->delete()

        return redirect()->route('exports.schedule.index')
            ->with('success', 'Export schedule deleted.');
    }
}
