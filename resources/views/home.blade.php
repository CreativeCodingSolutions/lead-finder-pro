<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Finder Pro — Lokale Leads aus OpenStreetMap finden</title>
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
</head>
<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass-chart text-primary text-2xl"></i>
                    <span class="font-bold text-xl text-gray-900">Lead Finder Pro</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-primary transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition">Kostenlos starten</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-100 text-primary px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                <i class="fa-solid fa-bolt"></i> Micro-SaaS für lokale Unternehmer
            </div>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                Finde <span class="text-primary">lokale Leads</span> automatisch<br>aus OpenStreetMap
            </h1>
            <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto">
                Suche nach Branche, Stadt & Radius — erhalte sofort Kontaktdaten von lokalen Unternehmen. Mit Telefon, Email, Website & mehr.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-3.5 rounded-xl text-lg font-medium hover:bg-secondary transition shadow-lg shadow-primary/25">
                    <i class="fa-solid fa-rocket mr-2"></i>Jetzt kostenlos starten
                </a>
                <a href="#features" class="bg-white text-gray-700 border border-gray-200 px-8 py-3.5 rounded-xl text-lg font-medium hover:bg-gray-50 transition">
                    <i class="fa-solid fa-play mr-2"></i>So funktioniert's
                </a>
            </div>
            <p class="text-sm text-gray-400 mt-4">Demo-Zugang: demo@example.com / password</p>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-4">Alles was du brauchst</h2>
            <p class="text-gray-500 text-center mb-16 max-w-xl mx-auto">Lead Finder Pro durchsucht OpenStreetMap und findet automatisch lokale Geschäfte mit Kontaktdaten in deiner Nähe.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-map-location-dot text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">OpenStreetMap Suche</h3>
                    <p class="text-gray-500 text-sm">Durchsuche über 70+ Branchen — von Ärzten bis Handwerker, mit echten OSM-Koordinaten.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-address-card text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Kontaktdaten finden</h3>
                    <p class="text-gray-500 text-sm">Email, Telefon, Website & Adresse — automatisch extrahiert aus OpenStreetMap-Daten.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-file-csv text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">CSV Export</h3>
                    <p class="text-gray-500 text-sm">Exportiere deine Leads als CSV und importiere sie direkt in dein CRM oder Mail-Tool.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-check-double text-emerald-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Website-Validierung</h3>
                    <p class="text-gray-500 text-sm">Prüfe automatisch ob Websites erreichbar sind — erhalte nur qualifizierte Leads.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-filter text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Smarte Filter</h3>
                    <p class="text-gray-500 text-sm">Filtere nach Website, Email, Telefon oder Status — finde genau die Leads die du brauchst.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <i class="fa-solid fa-shield-halved text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Duplikat-Erkennung</h3>
                    <p class="text-gray-500 text-sm">Automatische Deduplizierung — keine doppelten Leads bei mehreren Suchläufen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-4">Einfache Preise</h2>
            <p class="text-gray-500 text-center mb-16">Keine versteckten Kosten, keine Ablaufgebühren.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-gray-200">
                    <h3 class="text-lg font-semibold mb-1">Free</h3>
                    <p class="text-gray-400 text-sm mb-4">Zum Testen</p>
                    <p class="text-4xl font-bold text-gray-900 mb-6">€0</p>
                    <ul class="space-y-3 text-sm text-gray-600 mb-8">
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>3 Suchläufe/Monat</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>50 Leads pro Suche</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>CSV Export</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Website-Validierung</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center w-full border border-gray-200 text-gray-700 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition">Kostenlos starten</a>
                </div>

                <div class="bg-white rounded-2xl p-8 border-2 border-primary relative shadow-lg shadow-primary/10">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-medium px-3 py-1 rounded-full">Beliebt</div>
                    <h3 class="text-lg font-semibold mb-1">Pro</h3>
                    <p class="text-gray-400 text-sm mb-4">Für wachsende Teams</p>
                    <p class="text-4xl font-bold text-gray-900 mb-6">€29<span class="text-base font-normal text-gray-400">/Mo</span></p>
                    <ul class="space-y-3 text-sm text-gray-600 mb-8">
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Unlimitierte Suchen</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>500 Leads pro Suche</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>CSV + API Export</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Website-Validierung</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Email-Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center w-full bg-primary text-white py-2.5 rounded-xl font-medium hover:bg-secondary transition">Jetzt upgraden</a>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-gray-200">
                    <h3 class="text-lg font-semibold mb-1">Business</h3>
                    <p class="text-gray-400 text-sm mb-4">Für Agenturen</p>
                    <p class="text-4xl font-bold text-gray-900 mb-6">€79<span class="text-base font-normal text-gray-400">/Mo</span></p>
                    <ul class="space-y-3 text-sm text-gray-600 mb-8">
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Alles in Pro</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Unlimitierte Leads</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>White-Label Export</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>API-Zugang</li>
                        <li><i class="fa-solid fa-check text-green-500 mr-2"></i>Prioritäts-Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center w-full border border-gray-200 text-gray-700 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition">Jetzt upgraden</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-20">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Häufige Fragen</h2>
            <div class="space-y-6">
                <div class="border-b border-gray-100 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Woher kommen die Daten?</h3>
                    <p class="text-gray-500 text-sm">Alle Daten stammen aus OpenStreetMap (OSM), der freien Weltkarte. Die Daten sind frei verfügbar und werden von unserer Software automatisch extrahiert.</p>
                </div>
                <div class="border-b border-gray-100 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ist die Nutzung kostenlos?</h3>
                    <p class="text-gray-500 text-sm">Der Free-Plan ist dauerhaft kostenlos. Für mehr Suchen und Leads gibt es die Pro- und Business-Pläne.</p>
                </div>
                <div class="border-b border-gray-100 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kann ich die Leads in mein CRM importieren?</h3>
                    <p class="text-gray-500 text-sm">Ja! Exportiere deine Leads als CSV-Datei und importiere sie in jedes gängige CRM, Mailchimp, HubSpot oder Excel.</p>
                </div>
                <div class="border-b border-gray-100 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Wie aktuell sind die Daten?</h3>
                    <p class="text-gray-500 text-sm">OpenStreetMap wird täglich von Freiwilligen aktualisiert. Die Daten sind in der Regel weniger als 24 Stunden alt.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-primary py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bereit, Leads zu finden?</h2>
            <p class="text-indigo-200 mb-8 text-lg">Starte jetzt kostenlos und finde deine ersten lokalen Leads in Minuten.</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-primary px-8 py-3.5 rounded-xl text-lg font-medium hover:bg-gray-100 transition">
                <i class="fa-solid fa-rocket mr-2"></i>Kostenlos registrieren
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass-chart text-primary text-xl"></i>
                    <span class="font-bold text-white">Lead Finder Pro</span>
                </div>
                <p class="text-gray-500 text-sm">© {{ date('Y') }} Lead Finder Pro. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>
</body>
</html>
