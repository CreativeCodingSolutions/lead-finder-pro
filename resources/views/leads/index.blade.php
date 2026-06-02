@extends('layouts.app')
@section('title', 'Leads - Lead Finder Pro')

@section('content')
<div class="bg-white rounded-xl shadow-sm border">
    <!-- Header & Filters -->
    <div class="p-6 border-b">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h2 class="text-lg font-semibold"><i class="fa-solid fa-users text-primary mr-2"></i>Alle Leads</h2>
            <div class="flex gap-2">
                <button onclick="validateAll()" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-sm font-medium hover:bg-emerald-100 transition">
                    <i class="fa-solid fa-check-double mr-1"></i>Websites prüfen
                </button>
                <a href="{{ route('leads.export', request()->query()) }}" class="px-3 py-1.5 bg-indigo-50 text-primary rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                    <i class="fa-solid fa-download mr-1"></i>CSV Export
                </a>
            </div>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('leads.index') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Branche</label>
                <select name="industry_id" class="px-3 py-1.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                    <option value="">Alle</option>
                    @foreach($industries as $ind)
                        <option value="{{ $ind->id }}" {{ request('industry_id') == $ind->id ? 'selected' : '' }}>{{ $ind->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Stadt</label>
                <input type="text" name="city" value="{{ request('city') }}" placeholder="Stadt..." class="px-3 py-1.5 border rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select name="status" class="px-3 py-1.5 border rounded-lg text-sm">
                    <option value="">Alle</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Neu</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Kontaktiert</option>
                    <option value="interested" {{ request('status') === 'interested' ? 'selected' : '' }}>Interessiert</option>
                    <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Konvertiert</option>
                </select>
            </div>
            <div class="flex gap-2 text-sm">
                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="with_website" value="1" {{ request('with_website') ? 'checked' : '' }} class="rounded text-primary"> Webseite</label>
                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="with_email" value="1" {{ request('with_email') ? 'checked' : '' }} class="rounded text-primary"> Email</label>
                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="with_phone" value="1" {{ request('with_phone') ? 'checked' : '' }} class="rounded text-primary"> Telefon</label>
                <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" name="validated" value="1" {{ request('validated') ? 'checked' : '' }} class="rounded text-primary"> Validiert</label>
            </div>
            <button type="submit" class="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                <i class="fa-solid fa-filter mr-1"></i>Filtern
            </button>
        </form>
    </div>

    <!-- Leads Table -->
    @if($leads->isEmpty())
        <div class="p-12 text-center">
            <i class="fa-solid fa-inbox text-4xl text-gray-200 mb-3"></i>
            <p class="text-gray-400">Keine Leads gefunden.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-500">
                        <th class="px-4 py-3 font-medium">Name</th>
                        <th class="px-4 py-3 font-medium">Branche</th>
                        <th class="px-4 py-3 font-medium">Stadt</th>
                        <th class="px-4 py-3 font-medium">Kontakt</th>
                        <th class="px-4 py-3 font-medium text-center">Info</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium text-right">Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr class="border-t hover:bg-gray-50" id="lead-{{ $lead->id }}">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $lead->name }}</div>
                            @if($lead->address)<div class="text-xs text-gray-400">{{ $lead->address }}</div>@endif
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $lead->industry?->name ?? '–' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $lead->city }} {{ $lead->postal_code }}</td>
                        <td class="px-4 py-3">
                            @if($lead->email)<div class="text-xs"><a href="mailto:{{ $lead->email }}" class="text-blue-600 hover:underline">{{ $lead->email }}</a></div>@endif
                            @if($lead->phone)<div class="text-xs text-gray-500">{{ $lead->phone }}</div>@endif
                            @if($lead->website)<div class="text-xs"><a href="{{ $lead->website }}" target="_blank" class="text-indigo-600 hover:underline"><i class="fa-solid fa-external-link text-xs mr-1"></i>Webseite</a></div>@endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-1">
                                @if($lead->has_website)
                                    @if($lead->website_valid === true) <i class="fa-solid fa-globe text-green-500" title="Website OK"></i>
                                    @elseif($lead->website_valid === false) <i class="fa-solid fa-globe text-red-400" title="Website nicht erreichbar"></i>
                                    @else <i class="fa-solid fa-globe text-gray-300" title="Nicht geprüft"></i> @endif
                                @endif
                                @if($lead->has_email) <i class="fa-solid fa-envelope text-blue-500" title="Email"></i> @endif
                                @if($lead->has_phone) <i class="fa-solid fa-phone text-orange-500" title="Telefon"></i> @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <select onchange="updateStatus({{ $lead->id }}, this.value)" class="text-xs border rounded px-2 py-1 focus:ring-1 focus:ring-primary outline-none">
                                <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>Neu</option>
                                <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Kontaktiert</option>
                                <option value="interested" {{ $lead->status === 'interested' ? 'selected' : '' }}>Interessiert</option>
                                <option value="converted" {{ $lead->status === 'converted' ? 'selected' : '' }}>Konvertiert</option>
                                <option value="archived" {{ $lead->status === 'archived' ? 'selected' : '' }}>Archiviert</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if($lead->has_website && is_null($lead->website_valid))
                                <button onclick="validateWebsite({{ $lead->id }})" class="text-xs text-emerald-600 hover:text-emerald-800 mr-2" title="Website prüfen"><i class="fa-solid fa-rotate"></i></button>
                            @endif
                            <button onclick="deleteLead({{ $lead->id }})" class="text-xs text-red-400 hover:text-red-600" title="Löschen"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">{{ $leads->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function getCsrf() { return document.querySelector('meta[name="csrf-token"]').content; }

function updateStatus(id, status) {
    fetch(`/leads/${id}/status`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrf() },
        body: JSON.stringify({ status })
    }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
}

function deleteLead(id) {
    if(!confirm('Lead löschen?')) return;
    fetch(`/leads/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': getCsrf() } })
    .then(r => r.json()).then(d => { if(d.success) document.getElementById(`lead-${id}`).remove(); });
}

function validateWebsite(id) {
    fetch(`/leads/${id}/validate`, { method: 'POST', headers: { 'X-CSRF-TOKEN': getCsrf() } })
    .then(r => r.json()).then(d => { alert(d.message); location.reload(); });
}

function validateAll() {
    fetch('/leads/validate-all', { method: 'POST', headers: { 'X-CSRF-TOKEN': getCsrf() } })
    .then(r => r.json()).then(d => { alert(d.message); location.reload(); });
}
</script>
@endpush
