<?php

namespace App\Services;

use App\Models\Industry;
use App\Models\Lead;
use App\Models\Search;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OverpassLeadFinderService
{
    private Client $httpClient;
    private const OVERPASS_URL = 'https://overpass-api.de/api/interpreter';
    private const NOMINATIM_URL = 'https://nominatim.openstreetmap.org';
    private const MAX_RESULTS = 500;
    private const REQUEST_TIMEOUT = 30;

    // Map of OSM amenity/office tags to industry slugs
    private const TAG_MAP = [
        'physiotherapist' => ['amenity' => 'physiotherapist'],
        'psychotherapist' => ['healthcare' => 'psychotherapist'],
        'psychologist' => ['healthcare' => 'psychologist', 'amenity' => 'psychologist'],
        'coach' => ['office' => 'coach', 'office' => 'consulting'],
        'heilpraktiker' => ['healthcare' => 'alternative', 'amenity' => 'alternative'],
        'osteopath' => ['healthcare' => 'osteopath'],
        'chiropractor' => ['healthcare' => 'chiropractor'],
        'arzt' => ['amenity' => 'doctors'],
        'zahnarzt' => ['amenity' => 'dentist'],
        'anwalt' => ['office' => 'lawyer'],
        'steuerberater' => ['office' => 'tax_advisor'],
        'versicherung' => ['office' => 'insurance'],
        'immobilien' => ['office' => 'estate_agent'],
        'restaurant' => ['amenity' => 'restaurant'],
        'hotel' => ['tourism' => 'hotel'],
        'friseur' => ['shop' => 'hairdresser'],
        'kosmetik' => ['shop' => 'beauty'],
        'handwerker' => ['craft' => ''],
        'maler' => ['craft' => 'painter'],
        'elektriker' => ['craft' => 'electrician'],
        'sanitaer' => ['craft' => 'plumber'],
        'tischler' => ['craft' => 'carpenter'],
        'gartenbau' => ['craft' => 'gardener'],
        'reinigung' => ['craft' => 'cleaner'],
        'it-dienstleister' => ['office' => 'it'],
        'webdesign' => ['office' => 'design', 'craft' => 'graphic_designer'],
        'marketing' => ['office' => 'advertising', 'office' => 'marketing'],
        'fitness' => ['leisure' => 'fitness_centre', 'amenity' => 'gym'],
        'yoga' => ['leisure' => 'yoga', 'amenity' => 'yoga'],
        'praxis' => ['amenity' => 'clinic', 'healthcare' => ''],
        'apotheke' => ['amenity' => 'pharmacy'],
        'kita' => ['amenity' => 'kindergarten'],
        'schule' => ['amenity' => 'school'],
        'hochschule' => ['amenity' => 'university'],
        'bäckerei' => ['shop' => 'bakery'],
        'metzgerei' => ['shop' => 'butcher'],
        'supermarkt' => ['shop' => 'supermarket'],
        'autowerkstatt' => ['shop' => 'car_repair'],
        'autohaus' => ['shop' => 'car'],
        'cafés' => ['amenity' => 'cafe'],
        'bar' => ['amenity' => 'bar'],
        'pub' => ['amenity' => 'pub'],
        'kino' => ['amenity' => 'cinema'],
        'museum' => ['tourism' => 'museum'],
        'bibliothek' => ['amenity' => 'library'],
        'verein' => ['office' => 'association'],
        'architekt' => ['office' => 'architect'],
        'ingenieur' => ['office' => 'engineer'],
        'buchhalter' => ['office' => 'accountant'],
        'uebersetzer' => ['office' => 'translator'],
        'fotograf' => ['craft' => 'photographer'],
        'event' => ['office' => 'event_management', 'amenity' => 'events_venue'],
        'logistik' => ['office' => 'logistics', 'office' => 'transport'],
        'druckerei' => ['craft' => 'printer'],
        'kuechen' => ['craft' => 'kitchen'],
        'bodenleger' => ['craft' => 'floorer'],
        'schornsteinfeger' => ['craft' => 'chimney_sweep'],
        'schreinerei' => ['craft' => 'joinery'],
        'metallbau' => ['craft' => 'metal_construction'],
        'dachdecker' => ['craft' => 'roofer'],
    ];

    public function __construct()
    {
        $this->httpClient = new Client([
            'timeout' => self::REQUEST_TIMEOUT,
            'headers' => [
                'User-Agent' => 'LeadFinderPro/1.0',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Find leads based on search parameters
     */
    public function findLeads(Search $search, ?Industry $industry = null): array
    {
        $city = $search->city;
        $country = $search->country ?? 'AT';
        $radius = $search->radius_km ?? 25;

        // Get coordinates for the city
        $coords = $this->geocodeCity($city, $country);
        if (!$coords) {
            Log::warning("Could not geocode city: {$city}, {$country}");
            return [];
        }

        // Build Overpass query
        $tags = $industry?->overpass_tags ?? $this->getTagsForIndustry($industry?->slug ?? '');
        $query = $this->buildOverpassQuery($coords['lat'], $coords['lon'], $radius * 1000, $tags);

        try {
            $response = $this->httpClient->post(self::OVERPASS_URL, [
                'body' => 'data=' . urlencode($query),
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $elements = $data['elements'] ?? [];

            return $this->parseElements($elements, $search, $industry);
        } catch (GuzzleException $e) {
            Log::error("Overpass API error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Build Overpass QL query for given tags around a coordinate
     */
    private function buildOverpassQuery(float $lat, float $lon, int $radiusMeters, array $tags): string
    {
        $parts = [];

        foreach ($tags as $key => $value) {
            if (empty($value)) {
                // Key-only search (any value)
                $parts[] = "node[\"{$key}\"](around:{$radiusMeters},{$lat},{$lon});";
                $parts[] = "way[\"{$key}\"](around:{$radiusMeters},{$lat},{$lon});";
            } else {
                $parts[] = "node[\"{$key}\"=\"{$value}\"](around:{$radiusMeters},{$lat},{$lon});";
                $parts[] = "way[\"{$key}\"=\"{$value}\"](around:{$radiusMeters},{$lat},{$lon});";
            }
        }

        $union = implode("\n    ", $parts);

        return <<<QUERY
[out:json][timeout:25];
(
    {$union}
);
out body center;
QUERY;
    }

    /**
     * Parse OSM elements into lead data
     */
    private function parseElements(array $elements, Search $search, ?Industry $industry): array
    {
        $leads = [];
        $seen = [];

        foreach ($elements as $element) {
            $tags = $element['tags'] ?? [];
            if (empty($tags)) continue;

            $name = $tags['name'] ?? $tags['operator'] ?? null;
            if (!$name) continue;

            // Deduplicate by name + city
            $city = $tags['addr:city'] ?? $tags['city'] ?? $search->city ?? '';
            $key = md5($name . $city);
            if (isset($seen[$key])) continue;
            $seen[$key] = true;

            $lat = $element['lat'] ?? $element['center']['lat'] ?? null;
            $lon = $element['lon'] ?? $element['center']['lon'] ?? null;

            $lead = [
                'name' => $name,
                'email' => $tags['email'] ?? null,
                'phone' => $tags['phone'] ?? $tags['contact:phone'] ?? null,
                'website' => $tags['website'] ?? $tags['contact:website'] ?? $tags['url'] ?? null,
                'address' => $tags['addr:street'] ?? null,
                'city' => $city,
                'postal_code' => $tags['addr:postcode'] ?? null,
                'country' => $search->country ?? 'AT',
                'latitude' => $lat,
                'longitude' => $lon,
                'source_url' => $element['type'] && $element['id']
                    ? "https://www.openstreetmap.org/{$element['type']}/{$element['id']}"
                    : null,
                'source_type' => 'overpass',
                'has_website' => !empty($tags['website'] ?? $tags['contact:website'] ?? null),
                'has_email' => !empty($tags['email'] ?? null),
                'has_phone' => !empty($tags['phone'] ?? $tags['contact:phone'] ?? null),
                'has_address' => !empty($tags['addr:street'] ?? null),
                'has_name' => !empty($name),
                'website_valid' => null,
                'status' => 'new',
            ];

            // Apply filters
            if ($search->filter_website && !$lead['has_website']) continue;
            if ($search->filter_email && !$lead['has_email']) continue;
            if ($search->filter_phone && !$lead['has_phone']) continue;
            if ($search->filter_name && !$lead['has_name']) continue;

            $leads[] = $lead;

            if (count($leads) >= self::MAX_RESULTS) break;
        }

        return $leads;
    }

    /**
     * Geocode a city name to coordinates using Nominatim
     */
    private function geocodeCity(string $city, string $country): ?array
    {
        try {
            $response = $this->httpClient->get(self::NOMINATIM_URL . '/search', [
                'query' => [
                    'q' => $city . ', ' . $country,
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            if (!empty($data[0])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lon' => (float) $data[0]['lon'],
                ];
            }
        } catch (GuzzleException $e) {
            Log::error("Nominatim geocoding error: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Get OSM tags for an industry slug
     */
    public function getTagsForIndustry(string $slug): array
    {
        return self::TAG_MAP[$slug] ?? ['office' => ''];
    }

    /**
     * Get all available industry tag mappings
     */
    public static function getAvailableIndustries(): array
    {
        return self::TAG_MAP;
    }

    /**
     * Validate a website URL (check if reachable)
     */
    public function validateWebsite(?string $url): bool
    {
        if (!$url) return false;

        // Normalize URL
        if (!str_starts_with($url, 'http')) {
            $url = 'https://' . $url;
        }

        try {
            $response = $this->httpClient->head($url, [
                'timeout' => 10,
                'allow_redirects' => true,
                'verify' => false,
            ]);
            return $response->getStatusCode() < 400;
        } catch (\Exception $e) {
            // Try HTTP fallback
            try {
                $response = $this->httpClient->get($url, [
                    'timeout' => 10,
                    'allow_redirects' => true,
                    'verify' => false,
                ]);
                return $response->getStatusCode() < 400;
            } catch (\Exception $e2) {
                return false;
            }
        }
    }
}
