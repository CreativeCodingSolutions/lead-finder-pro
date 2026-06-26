@extends('layouts.app')

@section('title', 'Blog | LeadFinderPro — B2B Leads & Outreach Tipps für Vertrieb')
@section('meta_description', 'Blog über B2B Lead-Generierung, Cold Outreach, Vertriebs-Strategie und DSGVO-konforme Akquise für Marketing-Agenturen und Vertriebsteams in DACH.')

@section('og_tags')
<meta property="og:title" content="Blog | LeadFinderPro — B2B Leads & Outreach Tipps">
<meta property="og:description" content="Tipps für B2B Lead-Generierung, Cold Outreach und Vertriebs-Strategie im DACH-Raum.">
<meta property="og:type" content="website">
<meta property="og:locale" content="de_DE">
@endsection

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "LeadFinderPro Blog",
    "description": "Tipps für B2B Lead-Generierung, Cold Outreach und Vertriebs-Strategie im DACH-Raum.",
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
    <p class="text-gray-500 mb-12">Tipps für B2B Lead-Generierung, Cold Outreach und Vertriebs-Strategie im DACH-Raum.</p>

    <div class="space-y-8">
        <!-- Post 1: Cold Outreach skalieren -->
        <article class="border-b border-gray-200 pb-8">
            <p class="text-sm text-indigo-600 font-medium mb-1">B2B Outreach & Skalierung</p>
            <h2 class="text-xl font-semibold mb-2">
                <a href="/blog/cold-outreach-skalieren-500-mails-pro-monat" class="hover:text-indigo-600">Cold Outreach skaliert: Von 50 zu 500 Mails pro Monat — ohne Spam</a>
            </h2>
            <p class="text-sm text-gray-400 mb-2">26. Juni 2026 · Lesezeit: 7 Min.</p>
            <p class="text-gray-600">Wie B2B-Agenturen ihre Outreach von 50 auf 500+ personalisierte Mails pro Monat skalieren — ohne Spam, DSGVO-konform, mit echten Results.</p>
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
