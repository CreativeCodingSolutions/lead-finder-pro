<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LeadFinderPro — Branchen-Leads für Ihren Vertrieb')</title>
    <meta name="description" content="@yield('meta_description', 'Finden Sie qualifizierte Leads aus OpenStreetMap — nach Branche und Ort. Für Marketing-Agenturen und Vertriebsteams in Deutschland, Österreich und Schweiz.')">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#4F46E5">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="keywords" content="Leads finden, Vertrieb, Marketing-Agenturen, B2B Leads, OpenStreetMap, Branchenbuch, DACH, Lead-Generierung">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'LeadFinderPro — Branchen-Leads für Ihren Vertrieb')">
    <meta property="og:description" content="@yield('og_description', 'Finden Sie qualifizierte Leads aus OpenStreetMap — nach Branche und Ort. Für Agenturen und Vertriebsteams in DACH.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="LeadFinderPro">
    <meta property="og:image" content="https://leadfinderpro.creativecoding.cloud/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="LeadFinderPro — Branchen-Leads für Ihren Vertrieb in 2 Minuten">
    <meta name="twitter:card" content="summary_large_image">
    @yield('og_tags')

    <!-- Schema.org Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CreativeCodingSolutions",
        "url": "https://creativecoding.cloud",
        "logo": "https://creativecoding.cloud/logo.png",
        "sameAs": [
            "https://github.com/creativecoding"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": ["German", "English"]
        }
    }
    </script>
    @yield('schema')

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
                    <a href="{{ route('profile.show') }}" class="text-sm text-gray-600 hover:text-primary transition">
                        <i class="fa-solid fa-user-circle mr-1"></i>{{ Auth::user()->name }}
                    </a>
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
            @endif

        @yield('content')
    </main>

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent" class="fixed bottom-0 left-0 right-0 z-[100] hidden">
        <div class="max-w-5xl mx-auto px-4 pb-4">
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex-1">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        <strong class="text-gray-900">Cookies & Datenschutz</strong><br>
                        Wir verwenden nur technisch notwendige Cookies für den Betrieb der Website. Kein Tracking, keine Werbung.
                        Details finden Sie in unserer <a href="/datenschutz" class="text-indigo-600 underline hover:text-indigo-800">Datenschutzerklärung</a>.
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <button id="cookie-accept" class="bg-indigo-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-indigo-700 transition">
                        Akzeptieren
                    </button>
                    <button id="cookie-decline" class="bg-gray-100 text-gray-700 text-sm font-medium px-5 py-2 rounded hover:bg-gray-200 transition">
                        Nur notwendige
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var STORAGE_KEY = 'leadfinder_cookie_consent';
        var banner = document.getElementById('cookie-consent');
        var existing = localStorage.getItem(STORAGE_KEY);
        if (!existing && banner) {
            banner.classList.remove('hidden');
        }
        var acceptBtn = document.getElementById('cookie-accept');
        if (acceptBtn) {
            acceptBtn.addEventListener('click', function() {
                localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: true, essential: true, timestamp: new Date().toISOString() }));
                if (banner) banner.classList.add('hidden');
            });
        }
        var declineBtn = document.getElementById('cookie-decline');
        if (declineBtn) {
            declineBtn.addEventListener('click', function() {
                localStorage.setItem(STORAGE_KEY, JSON.stringify({ consent: false, essential: true, timestamp: new Date().toISOString() }));
                if (banner) banner.classList.add('hidden');
            });
        }
    })();
    </script>

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
