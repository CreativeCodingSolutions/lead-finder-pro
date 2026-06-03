@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Lead Enrichment</h1>
        @if($leads->count() > 0)
        <form action="{{ route('enrichment.enrich-all') }}" method="POST">
            @csrf
            <button type="submit" class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                Enrich All ({{ $leads->count() }} pending)
            </button>
        </form>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        @if($leads->isEmpty())
            <p class="text-gray-500 text-center py-8">All leads are already enriched! ✓</p>
        @else
            <p class="text-gray-600 mb-4">Leads waiting for enrichment:</p>
            <div class="space-y-3">
                @foreach($leads as $lead)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-semibold">{{ $lead->company_name }}</div>
                        <div class="text-sm text-gray-500">{{ $lead->website }}</div>
                    </div>
                    <form action="{{ route('enrichment.enrich', $lead) }}" method="POST">
                        @csrf
                        <button type="submit" class="py-1 px-3 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            Enrich
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $leads->links() }}</div>
        @endif
    </div>
</div>
@endsection
