@extends('layouts.app')
@section('title', 'Team-Einladung — Lead Finder Pro')

@section('content')
<div class="max-w-md mx-auto mt-16">
    <div class="bg-white rounded-xl shadow-sm border p-8 text-center">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-envelope-open-text text-indigo-600 text-2xl"></i>
        </div>
        <h1 class="text-xl font-bold text-gray-900 mb-2">Team-Einladung</h1>
        <p class="text-sm text-gray-500 mb-6">
            Du wurdest eingeladen, einem Team bei Lead Finder Pro beizutreten.
        </p>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @else
            <form action="{{ route('collaboration.accept', request()->route('token')) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-check mr-2"></i>Einladung annehmen
                </button>
            </form>
        @endif

        <a href="{{ route('dashboard') }}" class="inline-block mt-4 text-sm text-gray-400 hover:text-gray-600">
            Zum Dashboard
        </a>
    </div>
</div>
@endsection
