@extends('layouts.app')

@section('title', 'Pricing — Lead Finder Pro')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Simple, Transparent Pricing</h1>
        <p class="text-xl text-gray-600">Start free. Upgrade when you need more.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <!-- Free Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Free</h2>
            <div class="text-4xl font-bold text-gray-900 mb-1">€0</div>
            <p class="text-gray-500 mb-6">forever</p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    3 searches per month
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    50 leads per search
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    CSV Export
                </li>
            </ul>
            <a href="{{ route('register') }}" class="block text-center w-full py-3 px-6 rounded-xl border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                Get Started
            </a>
        </div>

        <!-- Pro Plan -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-indigo-500 relative transform md:-translate-y-4">
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-indigo-500 text-white text-sm font-bold px-4 py-1 rounded-full">
                Most Popular
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Pro</h2>
            <div class="text-4xl font-bold text-indigo-600 mb-1">€29</div>
            <p class="text-gray-500 mb-6">/month</p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    50 searches per month
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    200 leads per search
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    CSV, Excel, PDF Export
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Lead Enrichment
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Analytics Dashboard
                </li>
            </ul>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="pro">
                <button type="submit" class="block text-center w-full py-3 px-6 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                    Start Pro Trial
                </button>
            </form>
        </div>

        <!-- Business Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Business</h2>
            <div class="text-4xl font-bold text-gray-900 mb-1">€79</div>
            <p class="text-gray-500 mb-6">/month</p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Unlimited searches
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    500 leads per search
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    All export formats
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    API Access
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Priority Support
                </li>
            </ul>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="business">
                <button type="submit" class="block text-center w-full py-3 px-6 rounded-xl border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Go Business
                </button>
            </form>
        </div>
    </div>

    <div class="text-center mt-12 text-gray-500 text-sm">
       Payments secured by Stripe. Cancel anytime. No hidden fees.
    </div>
</div>
@endsection
