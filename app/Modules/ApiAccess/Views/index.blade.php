@extends('layouts.app')
@section('title', 'API-Zugang - Lead Finder Pro')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            <i class="fa-solid fa-key text-indigo-500 mr-2"></i>API-Zugang
        </h1>
        <p class="text-sm text-gray-500 mt-1">Verwalte deine API-Keys und Integrations</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Create New Key -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Neuen API-Key erstellen</h2>
        <form action="{{ route('api-access.keys.create') }}" method="POST" class="flex gap-3">
            @csrf
            <input type="text" name="name" required placeholder="Name (z.B. Production)" class="flex-1 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fa-solid fa-plus mr-2"></i>Erstellen
            </button>
        </form>
    </div>

    <!-- Existing Keys -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">API-Keys</h2>
        @if(empty($keys))
            <p class="text-gray-500 text-sm py-4 text-center">Noch keine API-Keys erstellt.</p>
        @else
            <div class="space-y-3">
                @foreach($keys as $key)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <p class="font-semibold text-sm">{{ $key['name'] }}</p>
                            @if($key['active'])
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">Aktiv</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs">Inaktiv</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <code class="text-xs text-gray-500 bg-white px-2 py-0.5 rounded border font-mono">{{ $key['key'] }}</code>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Erstellt: {{ $key['created_at']->format('d.m.Y') }} · 
                            Zuletzt genutzt: {{ $key['last_used_at']?->diffForHumans() ?? 'nie' }}
                        </p>
                    </div>
                    <form action="{{ route('api-access.keys.revoke', $key['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 px-3 py-1.5 border border-red-200 rounded-lg hover:bg-red-50 transition">
                            Widerrufen
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- API Endpoints -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-lg font-semibold mb-4">Verfügbare Endpunkte</h2>
        <div class="space-y-2">
            @foreach($endpoints as $endpoint)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <span class="px-2 py-0.5 rounded text-xs font-bold {{ $endpoint['method'] === 'GET' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ $endpoint['method'] }}
                </span>
                <code class="text-sm font-mono text-gray-700">{{ $endpoint['path'] }}</code>
                <span class="text-xs text-gray-400 ml-auto">{{ $endpoint['description'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Usage Info -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 mt-6">
        <h3 class="font-semibold text-indigo-900 mb-2"><i class="fa-solid fa-circle-info mr-2"></i>Nutzungshinweis</h3>
        <p class="text-sm text-indigo-700">
            Verwende deinen API-Key im <code class="bg-indigo-100 px-1 rounded">Authorization</code> Header:
            <code class="bg-indigo-100 px-1 rounded">Bearer DEIN_API_KEY</code>
        </p>
    </div>
</div>
@endsection
