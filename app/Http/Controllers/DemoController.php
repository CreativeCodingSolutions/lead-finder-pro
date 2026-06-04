<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class DemoController extends Controller
{
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

        // Generate realistic sample leads based on industry + city
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
        $baseNames = [
            'Hausarztpraxis', 'Zahnarztpraxis', 'Physiotherapie', 'Augenarztpraxis',
            'Dermatologie', 'Orthopädie', 'HNO-Praxis', 'Praxis für Allgemeinmedizin',
        ];

        $streetNames = [
            'Hauptstraße', 'Bahnhofstraße', 'Kirchgasse', 'Schulstraße',
            'Gartenweg', 'Marktplatz', 'Mühlenweg', 'Lindenstraße',
        ];

        for ($i = 0; $i < 5; $i++) {
            $name = $baseNames[$i % count($baseNames)] . ' ' . chr(65 + $i);
            $street = $streetNames[$i % count($streetNames)] . ' ' . ($i + 1) * 3;

            $leads[] = [
                'name' => $name,
                'address' => $street,
                'city' => $city,
                'postal_code' => rand(10, 99) . rand(100, 999),
                'country' => $country,
                'phone' => '+49 ' . rand(100, 999) . ' ' . rand(100000, 999999),
                'website' => rand(0, 1) ? 'https://www.' . strtolower(str_replace([' ', 'ä', 'ö', 'ü', 'ß'], ['-', 'ae', 'oe', 'ue', 'ss'], $name)) . '.de' : null,
                'email' => rand(0, 1) ? 'info@' . strtolower(str_replace([' ', 'ä', 'ö', 'ü', 'ß'], ['-', 'ae', 'oe', 'ue', 'ss'], $name)) . '.de' : null,
                'industry' => $industry->name,
                'has_website' => rand(0, 1),
                'has_email' => rand(0, 1),
                'has_phone' => true,
            ];
        }

        return $leads;
    }
}
