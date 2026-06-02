@extends('layouts.app')
@section('title', 'Suchergebnisse - Lead Finder Pro')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">
            <i class="fa-solid fa-list-check text-primary mr-2"></i>Suchergebnisse
        </h1>
        <p class="text-gray-500 mt-1">
            {{ $search->industry?->name }} in {{ $search->city }}, {{ $search->country }}
            · {{ $leads->total() }} Leads gefunden
        </p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('leads.export', ['search_id' => $search->id]) }}" class="px-4 py-2 bg-indigo-50 text-primary rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
            <i class="fa-solid fa-download mr-1"></i>CSV Export
        </a>
        <a href="{{ route('search.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-secondary transition">
            <i class="fa-solid fa-plus mr-1"></i>Neue Suche
        </a>
    </div>
</div>

<!-- Filter Summary -->
<div class="bg-white rounded-xl shadow-sm border p-4 mb-6">
    <div class="flex flex-wrap gap-2 text-sm">
        <span class="px-2 py-1 bg-gray-100 rounded text-gray-600"><i class="fa-solid fa-industry mr-1"></i>{{ $search->industry?->name }}</span>
        <span class="px-2 py-1 bg-gray-100 rounded text-gray-600"><i class="fa-solid fa-location-dot mr-1"></i>{{ $search->city }}, {{ $search->country }}</span>
        <span class="px-2 py-1 bg-gray-100 rounded text-gray-600"><i class="fa-solid fa-circle-nodes mr-1"></i>{{ $search->radius_km }} km Radius</span>
        @if($search->filter_website) <span class="px-2 py-1 bg-green-50 text-green-700 rounded"><i class="fa-solid fa-globe mr-1"></i>Nur mit Webseite</span> @endif
        @if($search->filter_email) <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded"><i class="fa-solid fa-envelope mr-1"></i>Nur mit Email</span> @endif
        @if($search->filter_phone) <span class="px-2 py-1 bg-orange-50 text-orange-700 rounded"><i class="fa-solid fa-phone mr-1"></i>Nur mit Telefon</span> @endif
    </div>
</div>

<!-- Leads -->
@if($leads->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
        <i class="fa-solid fa-inbox text-4xl text-gray-200 mb-3"></i>
        <p class="text-gray-400">Keine Leads für diese Suche gefunden.</p>
    </div>
@else
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-500">
                        <th class="px-4 py-3 font-medium">Name</th>
                        <th class="px-4 py-3 font-medium">Adresse</th>
                        <th class="px-4 py-3 font-medium">Kontakt</th>
                        <th class="px-4 py-3 font-medium text-center">Info</th>
                        <th class="px-4 py-3 font-medium text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr class="border-t hover:bg-gray-50" id="lead-{{ $lead->id }}">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $lead->name }}</div>
                            @if($lead->source_url)<a href="{{ $lead->source_url }}" target="_blank" class="text-xs text-gray-400 hover:text-primary"><i class="fa-solid fa-map-pin mr-1"></i>OSM</a>@endif
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-xs">
                            @if($lead->address){{ $lead->address }}<br>@endif
                            {{ $lead->postal_code }} {{ $lead->city }}
                        </td>
                        <td class="px-4 py-3">
                            @if($lead->email)<div class="text-xs mb-1"><a href="mailto:{{ $lead->email }}" class="text-blue-600 hover:underline"><i class="fa-solid fa-envelope mr-1"></i>{{ $lead->email }}</a></div>@endif
                            @if($lead->phone)<div class="text-xs mb-1 text-gray-600"><i class="fa-solid fa-phone mr-1"></i>{{ $lead->phone }}</div>@endif
                            @if($lead->website)<div class="text-xs"><a href="{{ str_starts_with($lead->website, 'http') ? $lead->website : 'https://'.$lead->website }}" target="_blank" class="text-indigo-600 hover:underline"><i class="fa-solid fa-globe mr-1"></i>Webseite</a></div>@endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-1.5">
                                @if($lead->has_website)
                                    @if($lead->website_valid === true) <i class="fa-solid fa-circle-check text-green-500" title="Website OK"></i>
                                    @elseif($lead->website_valid === false) <i class="fa-solid fa-circle-xmark text-red-400" title="Nicht erreichbar"></i>
                                    @else <button onclick="validateWebsite({{ $lead->id }})" class="text-gray-300 hover:text-emerald-500" title="Prüfen"><i class="fa-solid fa-rotate"></i></button> @endif
                                @endif
                                @if($lead->has_email) <i class="fa-solid fa-envelope text-blue-500"></i> @endif
                                @if($lead->has_phone) <i class="fa-solid fa-phone text-orange-500"></i> @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button onclick="deleteLead({{ $lead->id }})" class="text-xs text-red-400 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">{{ $leads->appends(request()->query())->links() }}</div>
    </div>
@endif
@endsection

@push('scripts')
<script>
function getCsrf() { return document.querySelector('meta[name="csrf-token"]').content; }
function deleteLead(id) {
    if(!confirm('Lead löschen?')) return;
    fetch(`/leads/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': getCsrf() } })
    .then(r => r.json()).then(d => { if(d.success) document.getElementById(`lead-${id}`).remove(); });
}
function validateWebsite(id) {
    fetch(`/leads/${id}/validate`, { method: 'POST', headers: { 'X-CSRF-TOKEN': getCsrf() } })
    .then(r => r.json()).then(d => { alert(d.message); location.reload(); });
}
</script>
@endpush
