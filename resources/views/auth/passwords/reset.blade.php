@extends('layouts.auth')
@section('title', 'Passwort zurücksetzen - Lead Finder Pro')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-shield-halved text-primary text-4xl mb-3"></i>
            <h1 class="text-2xl font-bold text-gray-900">Passwort zurücksetzen</h1>
            <p class="text-gray-500 mt-2">Gib dein neues Passwort ein.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" required readonly
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Neues Passwort</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="Mindestens 8 Zeichen">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort bestätigen</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="Passwort wiederholen">
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                    <i class="fa-solid fa-check mr-2"></i>Passwort zurücksetzen
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">← Zurück zum Login</a>
            </p>
        </div>
    </div>
</div>
@endsection
