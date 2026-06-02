@extends('layouts.app')
@section('title', 'Suche - Lead Finder Pro')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Search Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border p-6 sticky top-24">
            <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-sliders text-primary mr-2"></i>Neue Suche</h2>
            <form action="{{ route('search.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Branche *</label>
                    <select name="industry_id" required class="w-full px-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                        <option value="">— Auswählen —</option>
                        @php $currentGroup = ''; @endphp
                        @foreach($industries as $ind)
                            @php
                                $group = match(true) {
                                    $ind->sort_order < 30 => 'Gesundheit & Wellness',
                                    $ind->sort_order < 50 => 'Recht & Finanzen',
                                    $ind->sort_order < 70 => 'IT & Digital',
                                    $ind->sort_order < 80 => 'Handwerk',
                                    $ind->sort_order < 90 => 'Gastronomie',
                                    $ind->sort_order < 100 => 'Beauty & Fitness',
                                    $ind->sort_order < 110 => 'Automotive',
                                    default => 'Sonstige',
                                };
                            @endphp
                            @if($group !== $currentGroup)
                                @if($currentGroup !== '') </optgroup> @endif
                                <optgroup label="{{ $group }}">
                                @php $currentGroup = $group; @endphp
                            @endif
                            <option value="{{ $ind->id }}" {{ old('industry_id') == $ind->id ? 'selected' : '' }}>{{ $ind->name }}</option>
                        @endforeach
                        @if($currentGroup !== '') </optgroup> @endif
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stadt *</label>
                    <input type="text" name="city" value="{{ old('city') }}" required placeholder="z.B. Wien, Graz, München"
                        class="w-full px-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">PLZ</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="z.B. 1010"
                            class="w-full px-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Land</label>
                        <select name="country" class="w-full px-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                            <option value="AT">Österreich</option>
                            <option value="DE">Deutschland</option>
                            <option value="CH">Schweiz</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Radius: <span id="radiusVal">25</span> km</label>
                    <input type="range" name="radius_km" value="25" min="1" max="100" class="w-full accent-indigo-600" oninput="document.getElementById('radiusVal').textContent=this.value">
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Filter</p>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="filter_name" value="1" checked class="rounded text-primary focus:ring-primary">
                            <span class="text-sm text-gray-600">Nur mit <strong>Name</strong></span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="filter_website" value="1" class="rounded text-primary focus:ring-primary">
                            <span class="text-sm text-gray-600">Nur mit <strong>Webseite</strong></span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="filter_email" value="1" class="rounded text-primary focus:ring-primary">
                            <span class="text-sm text-gray-600">Nur mit <strong>Email</strong></span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="filter_phone" value="1" class="rounded text-primary focus:ring-primary">
                            <span class="text-sm text-gray-600">Nur mit <strong>Telefon</strong></span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition">
                    <i class="fa-solid fa-play mr-2"></i>Suche starten
                </button>
            </form>
        </div>
    </div>

    <!-- Search History -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-4"><i class="fa-solid fa-clock-rotate-left text-gray-400 mr-2"></i>Suchverlauf</h2>

            @if($searches->isEmpty())
                <div class="text-center py-12">
                    <i class="fa-solid fa-magnifying-glass text-4xl text-gray-200 mb-3"></i>
                    <p class="text-gray-400">Noch keine Suchen durchgeführt.</p>
                    <p class="text-gray-300 text-sm">Starte deine erste Suche mit dem Formular links.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-3 font-medium">Branche</th>
                                <th class="pb-3 font-medium">Standort</th>
                                <th class="pb-3 font-medium text-center">Ergebnisse</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th class="pb-3 font-medium">Datum</th>
                                <th class="pb-3 font-medium text-right">Aktion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($searches as $s)
                            <tr class="border-b last:border-0 hover:bg-gray-50">
                                <td class="py-3 font-medium">{{ $s->industry?->name ?? '–' }}</td>
                                <td class="py-3 text-gray-600">{{ $s->city }}, {{ $s->country }}</td>
                                <td class="py-3 text-center">
                                    <span class="bg-indigo-50 text-primary px-2 py-0.5 rounded-full text-xs font-medium">{{ $s->result_count }}</span>
                                </td>
                                <td class="py-3">
                                    @if($s->status === 'completed') <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs"><i class="fa-solid fa-check mr-1"></i>Fertig</span>
                                    @elseif($s->status === 'running') <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs animate-pulse"><i class="fa-solid fa-spinner fa-spin mr-1"></i>Läuft</span>
                                    @elseif($s->status === 'failed') <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs"><i class="fa-solid fa-xmark mr-1"></i>Fehler</span>
                                    @else <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $s->status }}</span> @endif
                                </td>
                                <td class="py-3 text-gray-400 text-xs">{{ $s->created_at->format('d.m.Y H:i') }}</td>
                                <td class="py-3 text-right">
                                    @if($s->status === 'completed')
                                        <a href="{{ route('search.results', $s) }}" class="text-primary hover:underline text-xs font-medium">Anzeigen →</a>
                                    @endif
                                    <form action="{{ route('search.destroy', $s) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Suche und alle Leads löschen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $searches->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
