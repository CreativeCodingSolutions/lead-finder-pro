@extends('layouts.app')

@section('title', 'Impressum | LeadFinder Pro')
@section('meta_description', 'Impressum von LeadFinder Pro — B2B Lead Generation aus OpenStreetMap. CreativeCoding Solutions eG, Wien.')
@section('meta_keywords', 'Impressum, LeadFinder Pro, CreativeCoding Solutions, Kontakt')
@section('canonical', 'https://leadfinderpro.creativecoding.cloud/impressum')
@section('meta_robots', 'noindex, follow')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Impressum</h1>
    <div class="prose prose-gray max-w-none">
        <p class="text-lg text-gray-600 mb-6">Angaben gemäß § 5 TMG</p>
        <p class="mb-4">
            CreativeCoding Solutions eG<br>
            Karsten Brauner<br>
            1010 Wien<br>
            Österreich<br>
            Firmenbuch: 1234567890
        </p>
        <h2 class="text-xl font-semibold mt-8 mb-4">Kontakt</h2>
        <p class="mb-4">
            E-Mail: info@creativecoding.cloud
        </p>
        <h2 class="text-xl font-semibold mt-8 mb-4">EU-Streitschlichtung</h2>
        <p class="mb-4">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: 
            <a href="https://ec.europa.eu/consumers/odr/" class="text-indigo-600 hover:underline" target="_blank" rel="noopener">
                https://ec.europa.eu/consumers/odr/
            </a>
        </p>
    </div>
</div>
@endsection
