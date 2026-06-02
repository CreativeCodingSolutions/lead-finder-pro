<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lead Finder Pro')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6366F1',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
</head>
<body class="bg-gray-50 min-h-screen">
    @auth
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass-chart text-primary text-2xl"></i>
                        <span class="font-bold text-xl text-gray-900">Lead Finder Pro</span>
                    </a>
                    <div class="hidden md:flex ml-10 gap-1">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-primary' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-chart-pie mr-1"></i> Dashboard
                        </a>
                        <a href="{{ route('search.create') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('search.*') ? 'bg-indigo-50 text-primary' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i> Suche
                        </a>
                        <a href="{{ route('leads.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('leads.*') ? 'bg-indigo-50 text-primary' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <i class="fa-solid fa-list mr-1"></i> Leads
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500 hidden sm:block">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600 px-3 py-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @auth
    <!-- Mobile bottom nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
        <div class="flex justify-around py-2">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center px-3 py-1 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-gray-400' }}">
                <i class="fa-solid fa-chart-pie text-lg"></i>
                <span class="text-xs mt-1">Dashboard</span>
            </a>
            <a href="{{ route('search.create') }}" class="flex flex-col items-center px-3 py-1 {{ request()->routeIs('search.*') ? 'text-primary' : 'text-gray-400' }}">
                <i class="fa-solid fa-magnifying-glass text-lg"></i>
                <span class="text-xs mt-1">Suche</span>
            </a>
            <a href="{{ route('leads.index') }}" class="flex flex-col items-center px-3 py-1 {{ request()->routeIs('leads.*') ? 'text-primary' : 'text-gray-400' }}">
                <i class="fa-solid fa-list text-lg"></i>
                <span class="text-xs mt-1">Leads</span>
            </a>
        </div>
    </nav>
    <div class="md:hidden h-16"></div>
    @endauth

    @stack('scripts')
</body>
</html>
