<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeadFinderPro — Kostenlose Lead-Demo</title>
    <meta name="description" content="Testen Sie LeadFinderPro kostenlos. Branche + Ort eingeben und sofort Beispiel-Leads sehen. Keine Anmeldung nötig.">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Lead Demo, LeadFinderPro, OpenStreetMap Leads, Branchenbuch, DACH">
    <link rel="canonical" href="https://leadfinderpro.creativecoding.cloud/demo">
    <!-- Open Graph -->
    <meta property="og:title" content="LeadFinderPro — Kostenlose Lead-Demo">
    <meta property="og:description" content="Testen Sie LeadFinderPro kostenlos. Branche + Ort eingeben und sofort Beispiel-Leads sehen.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://leadfinderpro.creativecoding.cloud/demo">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="LeadFinderPro">
    <meta property="og:image" content="https://leadfinderpro.creativecoding.cloud/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="LeadFinderPro — Kostenlose Lead-Demo">
    <meta name="twitter:card" content="summary_large_image">
    <!-- Schema.org BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Startseite",
                "item": "https://leadfinderpro.creativecoding.cloud/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Demo",
                "item": "https://leadfinderpro.creativecoding.cloud/demo"
            }
        ]
    }
    </script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Nav -->
    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">LeadFinderPro</span>
            </a>
            <div class="flex items-center gap-6 text-sm">
                <a href="/demo" class="text-gray-600 hover:text-gray-900 font-medium">Demo</a>
                <a href="#preise" class="text-gray-600 hover:text-gray-900">Preise</a>
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="/register" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">Kostenlos starten</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Testen Sie LeadFinderPro kostenlos
            </h1>
            <p class="text-lg text-gray-600 max-w-xl mx-auto">
                Wählen Sie eine Branche und einen Ort. Sie sehen sofort 5 Beispiel-Leads. Für die volle Suche kostenlos registrieren.
            </p>
        </div>

        <!-- Search Form -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
            <form action="{{ route('demo.search') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Branche</label>
                        <select name="industry_id" required class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500 bg-white">
                            <option value="">Branche wählen...</option>
                            @foreach($industries as $ind)
                                <option value="{{ $ind->id }}">{{ $ind->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stadt</label>
                        <input type="text" name="city" required placeholder="z.B. München"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Land</label>
                        <select name="country" required class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-500 bg-white">
                            <option value="DE">Deutschland</option>
                            <option value="AT">Österreich</option>
                            <option value="CH">Schweiz</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gray-900 text-white px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-800 transition">
                    Beispiel-Leads anzeigen
                </button>
            </form>
        </div>

        <!-- Info -->
        <div class="text-center text-sm text-gray-500">
            <p>Dies ist eine Demo mit Beispaidaten. Registrieren Sie sich kostenlos für echte Suchen mit OpenStreetMap-Daten.</p>
        </div>
    </div>

    <!-- Pricing Teaser -->
    <section id="preise" class="bg-gray-50 border-t border-gray-200 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3 text-center">Preise</h2>
            <p class="text-gray-600 mb-8 text-center">Kostenlos starten, bei Bedarf upgraden.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                <div class="border border-gray-200 rounded-lg p-6 bg-white">
                    <h3 class="font-semibold text-gray-900 mb-1">Free</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-4">€0</p>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li>3 Suchen/Monat</li>
                        <li>50 Leads/Suche</li>
                        <li>Basis-Daten</li>
                    </ul>
                </div>
                <div class="border border-gray-300 rounded-lg p-6 bg-white">
                    <h3 class="font-semibold text-gray-900 mb-1">Pro</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-4">€49<span class="text-sm font-normal text-gray-500">/Monat</span></p>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li>Unbegrenzte Suchen</li>
                        <li>500 Leads/Suche</li>
                        <li>CSV-Export</li>
                        <li>Email-Verifikation</li>
                    </ul>
                    <a href="/register" class="inline-block mt-4 text-sm text-gray-900 underline hover:no-underline">7 Tage kostenlos testen →</a>
                </div>
                <div class="border border-gray-200 rounded-lg p-6 bg-white">
                    <h3 class="font-semibold text-gray-900 mb-1">Business</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-4">€99<span class="text-sm font-normal text-gray-500">/Monat</span></p>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li>Alles in Pro</li>
                        <li>API-Zugang</li>
                        <li>Team-Kollaboration</li>
                        <li>Lead-Enrichment</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <p class="text-sm text-gray-500">© {{ date('Y') }} LeadFinderPro. Ein Projekt von CreativeCodingSolutions.</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/datenschutz" class="hover:text-gray-900">Datenschutz</a>
                    <a href="/impressum" class="hover:text-gray-900">Impressum</a>
                    <a href="/agb" class="hover:text-gray-900">AGB</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
