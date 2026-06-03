@extends('layouts.app')
@section('title', 'Neuer Export Schedule - Lead Finder Pro')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('exports.schedule.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition">
            <i class="fa-solid fa-arrow-left mr-1"></i>Zurück zur Übersicht
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            <i class="fa-solid fa-calendar-plus text-indigo-500 mr-2"></i>Neuen Export Schedule erstellen
        </h1>
        <p class="text-sm text-gray-500 mb-6">Plane automatische Lead-Exports mit deinen gewünschten Einstellungen.</p>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('exports.schedule.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Schedule-Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="z.B. Wöchentlicher Restaurant-Report"
                    class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
            </div>

            <!-- Frequency -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Frequenz <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="frequency" value="daily" class="peer sr-only" {{ old('frequency') === 'daily' ? 'checked' : '' }}>
                        <div class="text-center py-3 px-4 border-2 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-sun text-yellow-500 text-lg mb-1"></i>
                            <p class="text-sm font-medium">Täglich</p>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="frequency" value="weekly" class="peer sr-only" {{ old('frequency') === 'weekly' ? 'checked' : '' }}>
                        <div class="text-center py-3 px-4 border-2 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-calendar-week text-purple-500 text-lg mb-1"></i>
                            <p class="text-sm font-medium">Wöchentlich</p>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="frequency" value="monthly" class="peer sr-only" {{ old('frequency', 'monthly') === 'monthly' ? 'checked' : '' }}>
                        <div class="text-center py-3 px-4 border-2 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-calendar-days text-orange-500 text-lg mb-1"></i>
                            <p class="text-sm font-medium">Monatlich</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Format -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Export-Format <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="format" value="csv" class="peer sr-only" {{ old('format', 'csv') === 'csv' ? 'checked' : '' }}>
                        <div class="flex items-center gap-3 py-3 px-4 border-2 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-file-csv text-green-600 text-xl"></i>
                            <div>
                                <p class="text-sm font-medium">CSV</p>
                                <p class="text-xs text-gray-400">Für Excel & Tabellen</p>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="format" value="json" class="peer sr-only" {{ old('format') === 'json' ? 'checked' : '' }}>
                        <div class="flex items-center gap-3 py-3 px-4 border-2 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:bg-gray-50 transition">
                            <i class="fa-solid fa-file-code text-blue-600 text-xl"></i>
                            <div>
                                <p class="text-sm font-medium">JSON</p>
                                <p class="text-xs text-gray-400">Für APIs & Integrationen</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Branche</label>
                    <input type="text" name="industry" value="{{ old('industry') }}" placeholder="z.B. Restaurants"
                        class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stadt</label>
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="z.B. Berlin"
                        class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-check mr-2"></i>Schedule erstellen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
