<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Country-specific demo data configuration
     */
    private const COUNTRY_CONFIG = [
        'DE' => [
            'phone_prefix' => '+49',
            'city_examples' => ['Berlin', 'München', 'Hamburg', 'Köln', 'Frankfurt'],
            'postal_code_format' => 'german', // 5 digits
        ],
        'AT' => [
            'phone_prefix' => '+43',
            'city_examples' => ['Wien', 'Graz', 'Linz', 'Salzburg', 'Innsbruck'],
            'postal_code_format' => 'austrian', // 4 digits
        ],
        'CH' => [
            'phone_prefix' => '+41',
            'city_examples' => ['Zürich', 'Genf', 'Basel', 'Bern', 'Lausanne'],
            'postal_code_format' => 'swiss', // 4 digits
        ],
    ];

    /**
     * Show the public search demo page
     */
    public function index()
    {
        $industries = Industry::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('demo.index', compact('industries'));
    }

    /**
     * Run a demo search — returns 5 example leads (no API call, uses sample data)
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'city' => 'required|string|max:100',
            'country' => 'required|string|size:2',
        ]);

        $industry = Industry::findOrFail($validated['industry_id']);
        $city = $validated['city'];
        $country = strtoupper($validated['country']);

        // Generate realistic sample leads based on industry + city + country
        $sampleLeads = $this->generateSampleLeads($industry, $city, $country);

        return view('demo.results', [
            'leads' => $sampleLeads,
            'industry' => $industry,
            'city' => $city,
            'country' => $country,
            'totalDemo' => count($sampleLeads),
        ]);
    }

    private function generateSampleLeads(Industry $industry, string $city, string $country): array
    {
        $leads = [];

        $config = self::COUNTRY_CONFIG[$country] ?? self::COUNTRY_CONFIG['DE'];
        $phonePrefix = $config['phone_prefix'];

        // Country-specific base names for demo leads
        $baseNamesByCountry = [
            'DE' => [
                'Hausarztpraxis', 'Zahnarztpraxis', 'Physiotherapie', 'Augenarztpraxis',
                'Dermatologie', 'Orthopädie', 'HNO-Praxis', 'Praxis für Allgemeinmedizin',
            ],
            'AT' => [
                'Ordination Dr.', 'Zahnarztpraxis', 'Physiotherapie', 'Augenarztpraxis',
                'Dermatologie', 'Orthopädie', 'HNO-Arzt', 'Allgemeinmedizin',
            ],
            'CH' => [
                'Praxis Dr.', 'Zahnzentrum', 'Physiotherapie', 'Augenklinik',
                'Dermatologie', 'Orthopädie', 'HNO-Praxis', 'Allgemeine Medizin',
            ],
        ];

        $streetNamesByCountry = [
            'DE' => [
                'Hauptstraße', 'Bahnhofstraße', 'Kirchgasse', 'Schulstraße',
                'Gartenweg', 'Marktplatz', 'Mühlenweg', 'Lindenstraße',
            ],
            'AT' => [
                'Hauptstraße', 'Bahnhofstraße', 'Kirchengasse', 'Schulstraße',
                'Gartenweg', 'Marktplatz', 'Mühlweg', 'Lindenstraße',
            ],
            'CH' => [
                'Hauptstrasse', 'Bahnhofstrasse', 'Kirchgasse', 'Schulstrasse',
                'Gartenweg', 'Marktplatz', 'Mühlenweg', 'Lindenstrasse',
            ],
        ];

        $tldByCountry = [
            'DE' => '.de',
            'AT' => '.at',
            'CH' => '.ch',
        ];

        $baseNames = $baseNamesByCountry[$country] ?? $baseNamesByCountry['DE'];
        $streetNames = $streetNamesByCountry[$country] ?? $streetNamesByCountry['DE'];
        $tld = $tldByCountry[$country] ?? '.de';
        $postalFormat = $config['postal_code_format'];

        for ($i = 0; $i < 5; $i++) {
            $name = $baseNames[$i % count($baseNames)] . ' ' . chr(65 + $i);
            $street = $streetNames[$i % count($streetNames)] . ' ' . ($i + 1) * 3;

            // Generate country-appropriate postal code
            $postalCode = $this->generatePostalCode($postalFormat);

            $leads[] = [
                'name' => $name,
                'address' => $street,
                'city' => $city,
                'postal_code' => $postalCode,
                'country' => $country,
                'phone' => null,
                'website' => null,
                'email' => null,
                'industry' => $industry->name,
                'has_website' => false,
                'has_email' => false,
                'has_phone' => false,
            ];
        }

        return $leads;
    }

    /**
     * Generate a postal code matching the country format
     */
    private function generatePostalCode(string $format): string
    {
        switch ($format) {
            case 'german':
                // German: 5 digits, 10000-99999
                return (string) rand(10000, 99999);
            case 'austrian':
                // Austrian: 4 digits, 1000-9999
                return (string) rand(1000, 9999);
            case 'swiss':
                // Swiss: 4 digits, 1000-9999
                return (string) rand(1000, 9999);
            default:
                return (string) rand(10000, 99999);
        }
    }
}
