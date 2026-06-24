@extends('layouts.app')

@section('title', 'Datenschutzerklärung | LeadFinder Pro')
@section('meta_description', 'Datenschutzerklärung von LeadFinder Pro — Informationen zum Umgang mit personenbezogenen Daten.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Datenschutzerklärung</h1>
    
    <div class="prose prose-gray max-w-none space-y-6">
        <h2 class="text-xl font-semibold mt-8 mb-4">1. Verantwortlicher</h2>
        <p>
            Karsten Brauner, CreativeCoding Solutions eG, 1010 Wien, Österreich<br>
            E-Mail: office@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Erhebung und Speicherung personenbezogener Daten</h2>
        <p>Folgende Daten werden erhoben:</p>
        <ul class="list-disc pl-6 space-y-1">
            <li>Name und E-Mail-Adresse (Registrierung)</li>
            <li>Suchanfragen und Ergebnisse</li>
            <li>Nutzungsdaten (Logfiles, IP-Adresse)</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">2.1 Speicherdauer</h2>
        <p>
            Personenbezogene Daten werden nur so lange aufbewahrt, wie es für die Erfüllung der Zwecke erforderlich ist.
            Konkrete Aufbewahrungsfristen:
        </p>
        <ul class="list-disc pl-6 space-y-1">
            <li><strong>Registrierungsdaten:</strong> Bis zum Widerruf bzw. Löschung des Kontos, spätestens 3 Jahre nach letzter Aktivität.</li>
            <li><strong>Suchanfragen:</strong> 90 Tage nach der jeweiligen Suche, danach automatische Löschung.</li>
            <li><strong>Logfiles (IP-Adressen):</strong> 14 Tage, danach werden IP-Adressen anonymisiert oder gelöscht.</li>
            <li><strong>Cookie-Consent-Einstellungen:</strong> 12 Monate, danach wird erneut abgefragt.</li>
        </ul>
        <p>
            Nach Ablauf der Aufbewahrungsfristen werden die Daten automatisch gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten
            (z.B. steuerrechtliche Aufbewahrung von 7 Jahren für Buchungsdaten) entgegenstehen.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Zweck der Datenverarbeitung</h2>
        <p>
            Die Daten werden ausschließlich für die Bereitstellung des Lead-Generation-Diensts verwendet.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Rechtsgrundlage</h2>
        <p>
            Art. 6 Abs. 1 lit. b und f DSGVO.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Ihre Rechte</h2>
        <p>
            Auskunft, Berichtigung, Löschung, Einschränkung, Übertragbarkeit, Widerspruch.<br>
            Kontakt: office@creativecoding.cloud
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Hosting</h2>
        <p>
            Hostinger International Ltd. — keine Weitergabe an Dritte.
        </p>

        <p class="text-sm text-gray-400 mt-8">Stand: Juni 2026</p>
    </div>
</div>
@endsection
