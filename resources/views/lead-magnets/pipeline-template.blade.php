<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Lead-Scoring & Pipeline-Tracking Template | LeadFinderPro</title>
    <meta name="description" content="Kostenloses Excel- und Google-Sheets-Template für Lead-Scoring, Pipeline-Tracking und Outreach-Automation. Für Agenturen in DACH.">
    <meta name="robots" content="noindex, follow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white border-b border-gray-200 py-3">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <span class="text-lg font-semibold text-gray-900">LeadFinderPro</span>
            <a href="/" class="text-sm text-indigo-600 hover:underline">Zurück zur Startseite</a>
        </div>
    </nav>

    <section class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">B2B Lead-Scoring & Pipeline-Tracker</h1>
        <p class="text-lg text-gray-600 mb-8">Das komplette Template für Agentur-Geschäftsführer: Scoring-Matrix, Pipeline-Tracking, Outreach-Templates und Dashboard — kostenlos als Excel + Google Sheets.</p>

        <!-- What's included -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
            <h2 class="font-semibold text-gray-900 mb-4">Was Sie erhalten</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Tab 1: Lead-atrix</h3>
                    <ul class="space-y-1 text-gray-600">
                        <li>• 5-Klassen-System (A/B/C/D/E Leads)</li>
                        <li>• BANT-Kriterien mit Gewichtung</li>
                        <li>• Automatische Score-Berechnung</li>
                        <li>• Ampel-System für Priorisierung</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Tab 2: Pipeline-Tracker</h3>
                    <ul class="space-y-1 text-gray-600">
                        <li>• Lead Quelle, Score, Stage, Wert</li>
                        <li>• Warnungen bei Stale Leads (>14 Tage)</li>
                        <li>• Pipeline-Wert und gewichteter Wert</li>
                        <li>• Conversion-Rates per Stage</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Tab 3: Outreach-Templates</h3>
                    <ul class="space-y-1 text-gray-600">
                        <li>10 E-Mail-Templates für verschiedene Stages</li>
                        <li>LinkedIn Outreach Sequenzen</li>
                        <li>Anruf-Skripte für kalte Kontakte</li>
                        <li>Follow-Up-Templates und Timing</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Tab 4: Dashboard</h3>
                    <ul class="space-y-1 text-gray-600">
                        <li>Conversion-Rates per Stage</li>
                        <li>Durchschnittlicher Sales-Zyklus</li>
                        <li>Top-Quellen-Ranking</li>
                        <li>30-Tage-Prognose</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Email Capture Form -->
        <form action="/pipeline-template/download" method="POST" class="bg-white border-2 border-indigo-200 rounded-xl p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Jetzt kostenlos Template erhalten</h2>
            <p class="text-sm text-gray-600 mb-6">E-Mail angeben und sofort Excel + Google Sheets Template erhalten.</p>

            <div class="flex flex-col gap-4">
                <div>
                    <label for="lm-email" class="block text-sm font-medium text-gray-700 mb-1">E-Mail-Adresse</label>
                    <input type="email" id="lm-email" name="email" required placeholder="ihre@agentur.de" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="lm-company" class="block text-sm font-medium text-gray-700 mb-1">Agentur <span class="text-gray-400">(optional)</span></label>
                    <input type="text" id="lm-company" name="company" placeholder="Agentur XYZ GmbH" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
                <div class="flex items-start gap-2">
                    <input type="checkbox" id="consent" name="consent" required class="mt-1">
                    <label for="consent" class="text-xs text-gray-600">Ich bin damit einverstanden, dass meine E-Mail-Adresse für den Versand des Templates genutzt wird. Meine Einwilligung kann ich jederzeit widerrufen. (<a href="/datenschutz" class="underline" target="_blank">Datenschutz</a>)</label>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-base">
                    Template herunterladen (Excel + Sheets)
                </button>
                <p class="text-xs text-gray-500 text-center">✓ Keine Kreditkarte &nbsp; ✓ Kostenlos &nbsp; ✓ DSGVO-konform</p>
            </div>
        </form>
    </section>

    <footer class="border-t border-gray-200 bg-white py-6 mt-12">
        <div class="max-w-4xl mx-auto px-4 text-center text-sm text-gray-500">
            <a href="/datenschutz" class="underline">Datenschutz</a> &nbsp;|&nbsp; <a href="/impressum" class="underline">Impressum</a> &nbsp;|&nbsp; <a href="/agb" class="underline">AGB</a>
        </div>
    </footer>
</body>
</html>
