@extends('layouts.app')

@section('title', 'Blog | LeadFinderPro — B2B Leads & Outreach Tipps für Vertrieb')
@section('meta_description', 'Blog über B2B Lead-Generierung, Kaltakquise, Vertriebs-Strategie und DSGVO-konforme Akquise für Marketing-Agenturen und Vertriebsteams in DACH.')

@section('og_tags')
<meta property="og:title" content="Blog | LeadFinderPro — B2B Leads & Outreach Tipps">
<meta property="og:description" content="Tipps für B2B Lead-Generierung, Kaltakquise und Vertriebs-Strategie im DACH-Raum.">
<meta property="og:type" content="website">
<meta property="og:locale" content="de_DE">
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "LeadFinderPro Blog",
    "description": "Tipps für B2B Lead-Generierung, Kaltakquise und Vertriebs-Strategie im DACH-Raum.",
    "publisher": {
        "@type": "Organization",
        "name": "LeadFinderPro"
    },
    "inLanguage": "de-DE"
}
</script>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-2">Blog</h1>
    <p class="text-gray-500 mb-12">Tipps für B2B Lead-Generierung, Kaltakquise und Vertriebs-Strategie im DACH-Raum.</p>

    <div class="space-y-8">
        <!-- Post 10 (NEU) - DACH Expansion Playbook -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">B2B Expansion <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Neu</span></p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/dach-expansion-playbook-2026" class="hover:text-indigo-600">DACH-Expansion Playbook: Wie Sie mit LeadFinderPro in neue Regionen expandieren</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">28. Juni 2026 · Lesezeit: 10 Min.</p>
            <p class="text-gray-600">Von 0 auf 1.080 Leads: Die Regionen-Strategie für B2B-Expansion im DACH-Raum. 5 Phasen, 3 Templates, €123/Monat Gesamtkosten.</p>
        </article>

        <!-- Post 4 - SEO Longtail -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">Lead-Recherche</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/lead-recherche-deutschland-2026" class="hover:text-indigo-600">Lead-Recherche Deutschland 2026: Wo Sie B2B-Kunden finden</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">27. Juni 2026 · Lesezeit: 9 Min.</p>
            <p class="text-gray-600">Praktische Lead-Recherche für den deutschen Markt: Quellen, Tools und Strategien für B2B-Vertriebsteams.</p>
        </article>

        <!-- Post 3 (NEU) - SEO Longtail -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">Akquise-Optimierung <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Neu</span></p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/cold-outreach-response-rate-2026" class="hover:text-indigo-600">Antwortraten bei Kaltakquise: Was funktioniert 2026 wirklich?</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">27. Juni 2026 · Lesezeit: 8 Min.</p>
            <p class="text-gray-600">Daten und Benchmarks zu Kaltakquise-Antwortraten — und welche Faktoren den Unterschied machen.</p>
        </article>

        <!-- Post 2: Kaltakquise skalieren -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">B2B Akquise & Skalierung</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/cold-outreach-skalieren-500-mails-pro-monat" class="hover:text-indigo-600">Kaltakquise skalieren: Von 50 zu 500 Mails pro Monat — ohne Spam</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">26. Juni 2026 · Lesezeit: 7 Min.</p>
            <p class="text-gray-600">Wie B2B-Agenturen ihre Akquise von 50 auf 500+ personalisierte Mails pro Monat skalieren — ohne Spam, DSGVO-konform, mit echten Ergebnissen.</p>
        </article>
    </div>

    <!-- CTA -->
    <div class="mt-12 bg-indigo-50 border border-indigo-200 rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-indigo-900 mb-2">Leads finden — kostenlos testen</h3>
        <p class="text-indigo-800 text-sm mb-4">3 Suchläufe kostenlos, keine Kreditkarte. Finden Sie Agenturen, Praxen oder Unternehmen in 2 Minuten.</p>
        <a href="/" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Jetzt Leads finden →</a>
    </div>
</div>
@endsection
