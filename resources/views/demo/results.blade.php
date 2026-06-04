<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo-Ergebnisse — LeadFinderPro</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
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
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="/register" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800 text-sm">Kostenlos starten</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Demo-Ergebnisse</h1>
            <p class="text-gray-600">{{ $industry->name }} in {{ $city }}, {{ $country }} — {{ $totalDemo }} Beispiel-Leads</p>
        </div>

        <!-- Demo Notice -->
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg p-4 mb-6 text-sm">
            <strong>Hinweis:</strong> Dies sind Beispieldaten. Registrieren Sie sich kostenlos, um echte Leads aus OpenStreetMap zu erhalten.
        </div>

        <!-- Leads Table -->
        <div class="border border-gray-200 rounded-lg overflow-hidden mb-8">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Name</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Adresse</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Kontakt</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-700">Web</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($leads as $lead)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <span class="font-medium text-gray-900">{{ $lead['name'] }}</span>
                                <br><span class="text-xs text-gray-500">{{ $lead['industry'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $lead['address'] }}<br>
                                {{ $lead['postal_code'] }} {{ $lead['city'] }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                @if($lead['phone'])
                                    <span class="block">{{ $lead['phone'] }}</span>
                                @endif
                                @if($lead['email'])
                                    <span class="block text-blue-600">{{ $lead['email'] }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($lead['website'])
                                    <span class="inline-flex items-center gap-1 text-green-600 text-xs">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Website
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-red-500 text-xs">
                                        <span class="w-2 h-2 bg-red-400 rounded-full"></span> Keine
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- CTA -->
        <div class="bg-gray-900 text-white rounded-lg p-8 text-center">
            <h2 class="text-xl font-bold mb-2">Bereit für echte Leads?</h2>
            <p class="text-gray-300 mb-6 text-sm max-w-md mx-auto">
                Registrieren Sie sich kostenlos und erhalten Sie 3 echte Suchen mit Daten aus OpenStreetMap. Keine Kreditkarte nötig.
            </p>
            <a href="/register" class="inline-block bg-white text-gray-900 px-6 py-2.5 rounded text-sm font-medium hover:bg-gray-100 transition">
                Kostenlos registrieren
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-8 mt-8">
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
