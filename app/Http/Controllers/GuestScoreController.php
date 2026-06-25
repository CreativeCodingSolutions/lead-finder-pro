<?php

namespace App\Http\Controllers;

use App\Models\GuestScore;
use App\Models\Industry;
use App\Models\Lead;
use App\Notifications\LeadVerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestScoreController extends Controller
{
    /**
     * Country-specific demo data configuration
     */
    private const COUNTRY_CONFIG = [
        'DE' => [
            'phone_prefix' => '+49',
            'city_examples' => ['Berlin', 'München', 'Hamburg', 'Köln', 'Frankfurt'],
            'postal_code_format' => 'german',
        ],
        'AT' => [
            'phone_prefix' => '+43',
            'city_examples' => ['Wien', 'Graz', 'Linz', 'Salzburg', 'Innsbruck'],
            'postal_code_format' => 'austrian',
        ],
        'CH' => [
            'phone_prefix' => '+41',
            'city_examples' => ['Zürich', 'Genf', 'Basel', 'Bern', 'Lausanne'],
            'postal_code_format' => 'swiss',
        ],
    ];

    /**
     * Show the guest score landing page (public, no login)
     */
    public function index()
    {
        $industries = Industry::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('guest.index', compact('industries'));
    }

    /**
     * Run a guest score analysis — generates sample leads and shows score
     */
    public function analyze(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'industry_id' => 'required|exists:industries,id',
            'city' => 'required|string|max:100',
            'country' => 'required|string|size:2',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $industry = Industry::findOrFail($request->input('industry_id'));
        $city = $request->input('city');
        $country = strtoupper($request->input('country'));

        // Generate sample leads (same logic as DemoController)
        $sampleLeads = $this->generateSampleLeads($industry, $city, $country);
        $leadCount = count($sampleLeads);
        $score = GuestScore::calculateScore($leadCount, $sampleLeads);

        // Store guest score
        $guestScore = GuestScore::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'industry_name' => $industry->name,
            'city' => $city,
            'country' => $country,
            'lead_count' => $leadCount,
            'score' => $score,
            'sample_leads' => $sampleLeads,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('guest.score.show', $guestScore->uuid);
    }

    /**
     * Show the guest score result with email capture
     */
    public function show(string $uuid)
    {
        $guestScore = GuestScore::where('uuid', $uuid)->firstOrFail();

        // Check if already captured
        $captured = Lead::where('guest_score_id', $guestScore->id)
            ->whereNotNull('email_verified_at')
            ->exists();

        return view('guest.show', compact('guestScore', 'captured'));
    }

    /**
     * Capture email for full report access
     */
    public function captureEmail(Request $request, string $uuid)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
            'consent' => 'required|accepted',
        ], [
            'consent.accepted' => 'Bitte akzeptieren Sie die Datenschutzerklärung, um fortzufahren.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $guestScore = GuestScore::where('uuid', $uuid)->firstOrFail();

        // Save lead with lfp_landing source
        $lead = Lead::create([
            'guest_score_id' => $guestScore->id,
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'city' => $guestScore->city,
            'country' => $guestScore->country,
            'source_type' => 'lfp_landing',
            'ip_address' => $request->ip(),
            'consent_given' => true,
            'consent_text' => 'Datenschutzerklärung akzeptiert am ' . now()->format('d.m.Y H:i'),
            'status' => 'new',
        ]);

        // Double-Opt-In: generate token and send verification email
        $token = $lead->generateVerificationToken();
        $lead->notify(new LeadVerificationEmail($token));

        // Mark guest score as captured
        $guestScore->update(['lead_captured' => true]);

        return redirect()->route('lead.verification.notice', ['lead_id' => $lead->id])
            ->with('success', 'Vielen Dank! Wir haben Ihnen einen Verifizierungslink gesendet. Bitte prüfen Sie Ihren Posteingang.');
    }

    private function generateSampleLeads(Industry $industry, string $city, string $country): array
    {
        $leads = [];

        $config = self::COUNTRY_CONFIG[$country] ?? self::COUNTRY_CONFIG['DE'];
        $phonePrefix = $config['phone_prefix'];

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

    private function generatePostalCode(string $format): string
    {
        switch ($format) {
            case 'german':
                return (string) rand(10000, 99999);
            case 'austrian':
                return (string) rand(1000, 9999);
            case 'swiss':
                return (string) rand(1000, 9999);
            default:
                return (string) rand(10000, 99999);
        }
    }
}
