@extends('layouts.app')

@section('title', 'Billing')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Billing & Subscription</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Current Plan</h2>
            <div class="flex items-center justify-between mb-4">
                <span class="text-3xl font-bold">{{ $subscription['plan'] }}</span>
                <span class="px-3 py-1 rounded-full text-sm {{ $subscription['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($subscription['status']) }}
                </span>
            </div>
            <p class="text-gray-600">Renews at: {{ $subscription['renews_at'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Usage</h2>
            <div class="mb-2 flex justify-between">
                <span>Credits used</span>
                <span class="font-semibold">{{ $subscription['used_credits'] }} / {{ $subscription['total_credits'] }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full" style="width: {{ ($subscription['used_credits'] / max($subscription['total_credits'], 1)) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <div class="flex gap-4">
        <a href="{{ route('billing.invoices') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            View Invoices
        </a>
        <a href="{{ route('pricing') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
            Change Plan
        </a>
    </div>
</div>
@endsection
