<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/sitemap.xml', function () {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $pages = [
        ['url' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['url' => '/pricing', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['url' => '/impressum', 'priority' => '0.1', 'changefreq' => 'yearly'],
        ['url' => '/datenschutz', 'priority' => '0.1', 'changefreq' => 'yearly'],
        ['url' => '/agb', 'priority' => '0.1', 'changefreq' => 'yearly'],
        ['url' => '/blog', 'priority' => '0.7', 'changefreq' => 'weekly'],
        ['url' => '/blog/b2b-marketing-attribution-agenturen', 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['url' => '/blog/b2b-lead-scoring-agenturen', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/dach-expansion-playbook-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/kaltakquise-antwortquote-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/lead-recherche-deutschland-2026', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/agentur-pipeline-boost-h2-2026-4-faktoren-rahmen', 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['url' => '/blog/kaltakquise-automation-agenturen-kw33', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/conversion-optimierung-lokale-dienstleister', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['url' => '/blog/cold-outreach-skalieren-500-mails-pro-monat', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ];

    $baseUrl = config('app.url');

    foreach ($pages as $page) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$baseUrl}{$page['url']}</loc>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
});
