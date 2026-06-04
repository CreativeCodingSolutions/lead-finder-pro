@extends('layouts.app')

@section('title', 'Webhooks – Lead Finder Pro')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
            <i class="fa-solid fa-bolt text-indigo-600 text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Webhook Integration</h1>
            <p class="text-sm text-gray-500">Zapier / Make.com – Events für neue Leads, Exporte und Statusänderungen</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Create Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-plus-circle text-indigo-500"></i>
            Neuen Webhook erstellen
        </h2>
        <form action="{{ route('webhooks.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="z.B. Zapier Lead Sync">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Webhook URL</label>
                    <input type="url" name="url" value="{{ old('url') }}" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="https://hooks.zapier.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event</label>
                    <select name="event" required
                        class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">– Event wählen –</option>
                        <option value="lead.created" {{ old('event') == 'lead.created' ? 'selected' : '' }}>Lead erstellt</option>
                        <option value="lead.updated" {{ old('event') == 'lead.updated' ? 'selected' : '' }}>Lead aktualisiert</option>
                        <option value="export.completed" {{ old('event') == 'export.completed' ? 'selected' : '' }}>Export abgeschlossen</option>
                        <option value="report.ready" {{ old('event') == 'report.ready' ? 'selected' : '' }}>Report fertig</option>
                    </select>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <i class="fa-solid fa-bolt"></i>
                Webhook erstellen
            </button>
        </form>
    </div>

    <!-- Webhooks List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold flex items-center gap-2">
                <i class="fa-solid fa-list text-indigo-500"></i>
                Deine Webhooks
                <span class="text-sm font-normal text-gray-400">({{ $webhooks->total() }})</span>
            </h2>
        </div>

        @if($webhooks->isEmpty())
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-bolt text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 mb-2">Noch keine Webhooks eingerichtet.</p>
                <p class="text-sm text-gray-400">Erstelle deinen ersten Webhook oben, um Events an Zapier oder Make.com zu senden.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left px-6 py-3 font-medium">Status</th>
                            <th class="text-left px-6 py-3 font-medium">Name</th>
                            <th class="text-left px-6 py-3 font-medium">Event</th>
                            <th class="text-left px-6 py-3 font-medium hidden md:table-cell">URL</th>
                            <th class="text-left px-6 py-3 font-medium hidden lg:table-cell">Getriggert</th>
                            <th class="text-right px-6 py-3 font-medium">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($webhooks as $webhook)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <form action="{{ route('webhooks.toggle', $webhook->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition {{ $webhook->is_active ? 'bg-indigo-600' : 'bg-gray-300' }}">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition {{ $webhook->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                    </button>
                                </form>
                                <span class="ml-2 text-xs {{ $webhook->is_active ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $webhook->is_active ? 'Aktiv' : 'Inaktiv' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $webhook->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $webhook->event === 'lead.created' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $webhook->event === 'lead.updated' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $webhook->event === 'export.completed' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $webhook->event === 'report.ready' ? 'bg-orange-100 text-orange-800' : '' }}
                                ">
                                    {{ $webhook->event }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 hidden md:table-cell max-w-xs truncate">{{ $webhook->url }}</td>
                            <td class="px-6 py-4 text-gray-500 hidden lg:table-cell">
                                @if($webhook->trigger_count > 0)
                                    {{ $webhook->trigger_count }}×
                                    @if($webhook->last_triggered_at)
                                        <span class="text-xs text-gray-400">({{ \Carbon\Carbon::parse($webhook->last_triggered_at)->diffForHumans() }})</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">–</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('webhooks.test', $webhook->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Test senden"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                            <i class="fa-solid fa-paper-plane"></i> Test
                                        </button>
                                    </form>
                                    <form action="{{ route('webhooks.destroy', $webhook->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Webhook wirklich löschen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Löschen"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $webhooks->links() }}
            </div>
        @endif
    </div>

    <!-- Info Box -->
    <div class="mt-8 p-4 bg-indigo-50 border border-indigo-100 rounded-xl text-sm text-indigo-700">
        <p class="font-semibold mb-1"><i class="fa-solid fa-info-circle mr-1"></i> Integration mit Zapier & Make.com</p>
        <p class="text-indigo-600">Erstelle einen "Webhook by Zapier" oder "Webhook by Make" Trigger und füge die URL hier ein. Bei ausgelösem Event sendet Lead Finder Pro einen POST-Request mit den relevanten Daten an deine URL.</p>
    </div>
</div>
@endsection
