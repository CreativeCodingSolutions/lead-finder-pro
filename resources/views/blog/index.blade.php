@extends('layouts.app')

@section('title', 'Blog | LeadFinderPro — B2B Leads & Outreach Tipps für Vertrieb')
@section('meta_description', 'B2B Lead Generation Deutschland: Tipps für Agentur Lead Generierung, Unternehmensdatenbank DACH & Kaltakquise. Kostenlos Leads finden →')

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
        <!-- Post 36 (NEU) - B2B Marketing Attribution für Agenturen -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">Marketing Attribution <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Neu</span></p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/b2b-marketing-attribution-agenturen" class="hover:text-indigo-600">B2B Marketing Attribution für Agenturen: Welcher Kanal bringt wirklich Kunden?</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">1. Juli 2026 · Lesezeit: 10 Min.</p>
            <p class="text-gray-600">5 Attributionsmodelle im Vergleich: First-Touch, Last-Touch, Linear, Time-Decay, U-Shaped. Mit Case Study einer Frankfurter Agentur und praktischem Implementierungsleitfaden.</p>
        </article>

        <!-- Post 35 (NEU) - B2B Lead-Scoring für Agenturen -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">B2B Lead-Scoring <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Neu</span></p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/b2b-lead-scoring-agenturen" class="hover:text-indigo-600">B2B Lead-Scoring: Wie Agenturen die besten Kunden finden</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">29. Juni 2026 · Lesezeit: 11 Min.</p>
            <p class="text-gray-600">B2B Lead Scoring für Agenturen: Systematisch die besten Kunden identifizieren — Scoring-Modelle, Automatisierung, Integration in Brevo und HubSpot.</p>
        </article>

        <!-- Post 32 (NEU) - Agentur Pipeline Boost H2/2026 -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">LeadFinderPro <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Neu</span></p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/agentur-pipeline-boost-h2-2026-4-faktoren-rahmen" class="hover:text-indigo-600">Agentur-Pipeline-Boost H2/2026: Der 4-Faktoren-Rahmen für 3x Close-Rate</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">1. Juli 2026 · Lesezeit: 10 Min.</p>
            <p class="text-gray-600">4 Faktoren für eine stärkere B2B-Pipeline: Leads, Deal-Size, Close-Rate und Verkaufstempo. Ergebnisse können je nach Branche variieren.</p>
        </article>

        <!-- Post 10 - DACH Expansion Leitfaden -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">B2B Expansion</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/dach-expansion-playbook-2026" class="hover:text-indigo-600">DACH-Expansion: Systematisch in neue Regionen expandieren</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">28. Juni 2026 · Lesezeit: 10 Min.</p>
            <p class="text-gray-600">Regionale Expansion im DACH-Raum mit persönlichem Bezug. 5 Phasen für eine skalierbare Strategie. Ergebnisse können variieren.</p>
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
                <a href="/blog/kaltakquise-antwortquote-2026" class="hover:text-indigo-600">Antwortraten bei Kaltakquise: Was funktioniert 2026 wirklich?</a>
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
