@extends('layouts.app')
@section('title', 'Team Collaboration — Lead Finder Pro')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                <i class="fa-solid fa-users text-indigo-500 mr-2"></i>Team Collaboration
            </h1>
            <p class="text-sm text-gray-500 mt-1">Lade Team-Mitglieder ein und verwalte Zugriffe.</p>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <i class="fa-solid fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Invite Form --}}
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-4">
                <i class="fa-solid fa-user-plus text-indigo-500 mr-2"></i>Mitglied einladen
            </h2>
            <form action="{{ route('collaboration.invite') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Email-Adresse</label>
                    <input type="email" name="email" required placeholder="colleague@company.com"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Rolle</label>
                    <select name="role" required
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none">
                        <option value="member">Mitglied</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Einladung senden
                </button>
            </form>
        </div>

        {{-- Team Members List --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-4">
                <i class="fa-solid fa-users text-green-500 mr-2"></i>Team-Mitglieder
            </h2>

            @if(empty($teamMembers))
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-users text-gray-300 text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-sm">Noch keine Team-Mitglieder.</p>
                    <p class="text-gray-400 text-xs mt-1">Lade jemanden ein, um zu starten!</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($teamMembers as $member)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-user text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $member['name'] ?? $member['email'] }}</p>
                                <p class="text-xs text-gray-500">{{ $member['role'] ?? 'member' }}</p>
                            </div>
                        </div>
                        <form action="{{ route('collaboration.remove', $member['id'] ?? 0) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 text-sm"
                                onclick="return confirm('Mitglied entfernen?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            @endif

            {{-- Pending Invites --}}
            @if(!empty($pendingInvites))
                <div class="mt-6 pt-6 border-t">
                    <h3 class="text-sm font-semibold text-gray-500 mb-3">
                        <i class="fa-solid fa-clock mr-1"></i>Offene Einladungen
                    </h3>
                    <div class="space-y-2">
                        @foreach($pendingInvites as $invite)
                        <div class="flex items-center justify-between p-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <span class="text-sm text-gray-700">{{ $invite['email'] }}</span>
                            <span class="text-xs text-yellow-600">Ausstehend</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
