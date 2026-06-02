@extends('layouts.app')
@section('title', 'Login - Lead Finder Pro')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fa-solid fa-magnifying-glass-chart text-primary text-5xl mb-4"></i>
            <h1 class="text-3xl font-bold text-gray-900">Lead Finder Pro</h1>
            <p class="text-gray-500 mt-2">Melde dich an, um Leads zu finden</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="deine@email.at">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwort</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                        placeholder="••••••••">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Angemeldet bleiben</label>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-medium hover:bg-secondary transition">
                    Anmelden
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Noch kein Konto? <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Registrieren</a>
            </p>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            Demo: demo@example.com / password
        </p>
    </div>
</div>
