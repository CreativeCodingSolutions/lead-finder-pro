@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Analytics Dashboard</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Total Searches</div>
            <div class="text-3xl font-bold text-indigo-600">{{ $totalSearches }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Success Rate</div>
            <div class="text-3xl font-bold text-green-600">{{ $successRate }}%</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">With Website</div>
            <div class="text-3xl font-bold text-blue-600">{{ $withWebsite }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Validated</div>
            <div class="text-3xl font-bold text-emerald-600">{{ $validated }}</div>
        </div>
    </div>

    <!-- Leads Over Time Chart -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Leads Over Time (Last 30 Days)</h2>
        <canvas id="leadsChart" height="100"></canvas>
    </div>

    <!-- Top Industries -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Top Industries</h2>
        @if($topIndustries->isEmpty())
            <p class="text-gray-500">No data yet. Start searching!</p>
        @else
            <div class="space-y-3">
                @foreach($topIndustries as $item)
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-indigo-500 h-4 rounded-full" style="width: {{ min(100, ($item->count / max(1, $topIndustries->first()->count)) * 100) }}%"></div>
                        </div>
                    </div>
                    <div class="w-32 text-sm font-medium">{{ $item->industry }}</div>
                    <div class="w-12 text-right text-sm text-gray-500">{{ $item->count }}</div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('leadsChart').getContext('2d');
const data = {
    labels: {!! json_encode($leadsOverTime->pluck('date')) !!},
    datasets: [{
        label: 'Leads',
        data: {!! json_encode($leadsOverTime->pluck('count')) !!},
        borderColor: '#6366f1',
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        fill: true,
        tension: 0.3
    }]
};
new Chart(ctx, { type: 'line', data });
</script>
@endpush
@endsection
