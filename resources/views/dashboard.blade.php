@extends('layouts.app')
@section('title', 'Dashboard - Lead Finder Pro')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Gesamt Leads</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_leads'] }}</p>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-users text-primary text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Suchanfragen</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_searches'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-magnifying-glass text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Mit Webseite</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['with_website'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-globe text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Validiert</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['validated'] }}</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-check-circle text-emerald-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Search -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-bolt text-yellow-500 mr-2"></i>Schnellsuche</h2>
        <form action="{{ route('search.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Branche</label>
                    <select name="industry_id" required class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                        @foreach(\App\Models\Industry::where('is_active', true)->orderBy('sort_order')->get() as $ind)
                            <option value="{{ $ind->id }}">{{ $ind->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Stadt</label>
                    <input type="text" name="city" required placeholder="z.B. Wien" class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Land</label>
                    <select name="country" class="w-full px-3 py-2 border rounded-lg text-sm">
                        <option value="AT">Österreich</option>
                        <option value="DE">Deutschland</option>
                        <option value="CH">Schweiz</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Radius (km)</label>
                    <input type="number" name="radius_km" value="25" min="1" max="100" class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
            </div>
            <div class="flex flex-wrap gap-3 text-sm">
                <label class="flex items-center gap-1"><input type="checkbox" name="filter_website" value="1" class="rounded text-primary"> Webseite</label>
                <label class="flex items-center gap-1"><input type="checkbox" name="filter_email" value="1" class="rounded text-primary"> Email</label>
                <label class="flex items-center gap-1"><input type="checkbox" name="filter_phone" value="1" class="rounded text-primary"> Telefon</label>
            </div>
            <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                <i class="fa-solid fa-play mr-2"></i>Suche starten
            </button>
        </form>
    </div>

    <!-- Recent Leads -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-clock-rotate-left text-primary mr-2"></i>Letzte Leads</h2>
        @if($stats['recent_leads']->isEmpty())
            <p class="text-gray-400 text-sm py-8 text-center">Noch keine Leads. Starte eine Suche!</p>
        @else
            <div class="space-y-3 max-h-80 overflow-y-auto">
                @foreach($stats['recent_leads'] as $lead)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="min-w-0 flex-1">
                        <p class="font-medium text-sm text-gray-900 truncate">{{ $lead->name }}</p>
                        <p class="text-xs text-gray-500">{{ $lead->city }} · {{ $lead->industry?->name ?? '–' }}</p>
                    </div>
                    <div class="flex gap-1 ml-2">
                        @if($lead->has_website) <i class="fa-solid fa-globe text-green-500 text-xs" title="Webseite"></i> @endif
                        @if($lead->has_email) <i class="fa-solid fa-envelope text-blue-500 text-xs" title="Email"></i> @endif
                        @if($lead->has_phone) <i class="fa-solid fa-phone text-orange-500 text-xs" title="Telefon"></i> @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Recent Searches -->
    <div class="bg-white rounded-xl shadow-sm border p-6 lg:col-span-2">
        <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-clock-rotate-left text-gray-400 mr-2"></i>Letzte Suchen</h2>
        @if($stats['recent_searches']->isEmpty())
            <p class="text-gray-400 text-sm py-8 text-center">Noch keine Suchen.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-2 font-medium">Branche</th>
                            <th class="pb-2 font-medium">Stadt</th>
                            <th class="pb-2 font-medium">Ergebnisse</th>
                            <th class="pb-2 font-medium">Status</th>
                            <th class="pb-2 font-medium">Datum</th>
                            <th class="pb-2 font-medium"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_searches'] as $s)
                        <tr class="border-b last:border-0">
                            <td class="py-3">{{ $s->industry?->name ?? '–' }}</td>
                            <td>{{ $s->city }}, {{ $s->country }}</td>
                            <td>{{ $s->result_count }}</td>
                            <td>
                                @if($s->status === 'completed') <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Fertig</span>
                                @elseif($s->status === 'running') <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">Läuft</span>
                                @elseif($s->status === 'failed') <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs">Fehler</span>
                                @else <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $s->status }}</span> @endif
                            </td>
                            <td class="text-gray-400">{{ $s->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                @if($s->status === 'completed')
                                    <a href="{{ route('search.results', $s) }}" class="text-primary hover:underline text-xs">Anzeigen</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
