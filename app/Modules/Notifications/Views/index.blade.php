@extends('layouts.app')
@section('title', 'Benachrichtigungen - Lead Finder Pro')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                <i class="fa-solid fa-bell text-yellow-500 mr-2"></i>Benachrichtigungen
            </h1>
            <p class="text-sm text-gray-500 mt-1">Alle Benachrichtigungen auf einen Blick</p>
        </div>
        @if(collect($notifications)->where('read', false)->count() > 0)
        <form action="{{ route('notifications.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-primary hover:underline">
                Alle als gelesen markieren
            </button>
        </form>
        @endif
    </div>

    @if(empty($notifications))
        <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
            <i class="fa-solid fa-bell-slash text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Keine Benachrichtigungen vorhanden.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($notifications as $notification)
            <div class="bg-white rounded-xl shadow-sm border p-4 flex items-start gap-4 {{ $notification['read'] ? 'opacity-60' : '' }}">
                <div class="w-10 h-10 {{ $notification['bg'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid {{ $notification['icon'] }} {{ $notification['color'] }}"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-sm text-gray-900">{{ $notification['title'] }}</p>
                        <span class="text-xs text-gray-400 flex-shrink-0 ml-2">{{ $notification['created_at']->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-0.5">{{ $notification['message'] }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if(!$notification['read'])
                    <form action="{{ route('notifications.read', $notification['id']) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs text-gray-400 hover:text-primary" title="Als gelesen markieren">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('notifications.destroy', $notification['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-gray-400 hover:text-red-500" title="Löschen">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <!-- Notification Stats -->
    <div class="grid grid-cols-3 gap-4 mt-8">
        <div class="bg-white rounded-xl shadow-sm border p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ count($notifications) }}</p>
            <p class="text-xs text-gray-500 mt-1">Gesamt</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border p-4 text-center">
            <p class="text-2xl font-bold text-orange-600">{{ collect($notifications)->where('read', false)->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Ungelesen</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ collect($notifications)->where('read', true)->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Gelesen</p>
        </div>
    </div>
</div>
@endsection
