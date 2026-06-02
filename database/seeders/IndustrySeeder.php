<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            // Gesundheit
            ['name' => 'Psychotherapie', 'slug' => 'psychotherapist', 'overpass_tags' => ['healthcare' => 'psychotherapist'], 'icon' => 'brain', 'sort_order' => 10],
            ['name' => 'Psychologie', 'slug' => 'psychologist', 'overpass_tags' => ['healthcare' => 'psychologist'], 'icon' => 'brain', 'sort_order' => 11],
            ['name' => 'Physiotherapie', 'slug' => 'physiotherapist', 'overpass_tags' => ['amenity' => 'physiotherapist'], 'icon' => 'activity', 'sort_order' => 12],
            ['name' => 'Heilpraktiker', 'slug' => 'heilpraktiker', 'overpass_tags' => ['healthcare' => 'alternative'], 'icon' => 'heart', 'sort_order' => 13],
            ['name' => 'Osteopathie', 'slug' => 'osteopath', 'overpass_tags' => ['healthcare' => 'osteopath'], 'icon' => 'bone', 'sort_order' => 14],
            ['name' => 'Chiropraktik', 'slug' => 'chiropractor', 'overpass_tags' => ['healthcare' => 'chiropractor'], 'icon' => 'bone', 'sort_order' => 15],
            ['name' => 'Coaches', 'slug' => 'coach', 'overpass_tags' => ['office' => 'coach'], 'icon' => 'users', 'sort_order' => 16],
            ['name' => 'Ärzte', 'slug' => 'arzt', 'overpass_tags' => ['amenity' => 'doctors'], 'icon' => 'stethoscope', 'sort_order' => 17],
            ['name' => 'Zahnärzte', 'slug' => 'zahnarzt', 'overpass_tags' => ['amenity' => 'dentist'], 'icon' => 'smile', 'sort_order' => 18],
            ['name' => 'Apotheken', 'slug' => 'apotheke', 'overpass_tags' => ['amenity' => 'pharmacy'], 'icon' => 'pill', 'sort_order' => 19],

            // Recht & Finanzen
            ['name' => 'Anwälte', 'slug' => 'anwalt', 'overpass_tags' => ['office' => 'lawyer'], 'icon' => 'scale', 'sort_order' => 30],
            ['name' => 'Steuerberater', 'slug' => 'steuerberater', 'overpass_tags' => ['office' => 'tax_advisor'], 'icon' => 'calculator', 'sort_order' => 31],
            ['name' => 'Buchhalter', 'slug' => 'buchhalter', 'overpass_tags' => ['office' => 'accountant'], 'icon' => 'book', 'sort_order' => 32],
            ['name' => 'Versicherungen', 'slug' => 'versicherung', 'overpass_tags' => ['office' => 'insurance'], 'icon' => 'shield', 'sort_order' => 33],
            ['name' => 'Immobilien', 'slug' => 'immobilien', 'overpass_tags' => ['office' => 'estate_agent'], 'icon' => 'home', 'sort_order' => 34],

            // IT & Digital
            ['name' => 'IT-Dienstleister', 'slug' => 'it-dienstleister', 'overpass_tags' => ['office' => 'it'], 'icon' => 'monitor', 'sort_order' => 40],
            ['name' => 'Webdesign', 'slug' => 'webdesign', 'overpass_tags' => ['office' => 'design'], 'icon' => 'palette', 'sort_order' => 41],
            ['name' => 'Marketing-Agenturen', 'slug' => 'marketing', 'overpass_tags' => ['office' => 'advertising'], 'icon' => 'megaphone', 'sort_order' => 42],

            // Handwerk
            ['name' => 'Maler', 'slug' => 'maler', 'overpass_tags' => ['craft' => 'painter'], 'icon' => 'brush', 'sort_order' => 50],
            ['name' => 'Elektriker', 'slug' => 'elektriker', 'overpass_tags' => ['craft' => 'electrician'], 'icon' => 'zap', 'sort_order' => 51],
            ['name' => 'Sanitär', 'slug' => 'sanitaer', 'overpass_tags' => ['craft' => 'plumber'], 'icon' => 'droplet', 'sort_order' => 52],
            ['name' => 'Tischler', 'slug' => 'tischler', 'overpass_tags' => ['craft' => 'carpenter'], 'icon' => 'hammer', 'sort_order' => 53],
            ['name' => 'Gartenbau', 'slug' => 'gartenbau', 'overpass_tags' => ['craft' => 'gardener'], 'icon' => 'trees', 'sort_order' => 54],
            ['name' => 'Dachdecker', 'slug' => 'dachdecker', 'overpass_tags' => ['craft' => 'roofer'], 'icon' => 'home', 'sort_order' => 55],
            ['name' => 'Bodenleger', 'slug' => 'bodenleger', 'overpass_tags' => ['craft' => 'floorer'], 'icon' => 'layout', 'sort_order' => 56],
            ['name' => 'Metallbau', 'slug' => 'metallbau', 'overpass_tags' => ['craft' => 'metal_construction'], 'icon' => 'wrench', 'sort_order' => 57],

            // Gastronomie & Hotellerie
            ['name' => 'Restaurants', 'slug' => 'restaurant', 'overpass_tags' => ['amenity' => 'restaurant'], 'icon' => 'utensils', 'sort_order' => 70],
            ['name' => 'Hotels', 'slug' => 'hotel', 'overpass_tags' => ['tourism' => 'hotel'], 'icon' => 'bed', 'sort_order' => 71],
            ['name' => 'Cafés', 'slug' => 'cafés', 'overpass_tags' => ['amenity' => 'cafe'], 'icon' => 'coffee', 'sort_order' => 72],
            ['name' => 'Bäckereien', 'slug' => 'bäckerei', 'overpass_tags' => ['shop' => 'bakery'], 'icon' => 'cookie', 'sort_order' => 73],

            // Beauty & Wellness
            ['name' => 'Friseure', 'slug' => 'friseur', 'overpass_tags' => ['shop' => 'hairdresser'], 'icon' => 'scissors', 'sort_order' => 80],
            ['name' => 'Kosmetik', 'slug' => 'kosmetik', 'overpass_tags' => ['shop' => 'beauty'], 'icon' => 'sparkles', 'sort_order' => 81],
            ['name' => 'Fitness-Studios', 'slug' => 'fitness', 'overpass_tags' => ['leisure' => 'fitness_centre'], 'icon' => 'dumbbell', 'sort_order' => 82],
            ['name' => 'Yoga-Studios', 'slug' => 'yoga', 'overpass_tags' => ['leisure' => 'yoga'], 'icon' => 'heart', 'sort_order' => 83],

            // Automotive
            ['name' => 'Autowerkstätten', 'slug' => 'autowerkstatt', 'overpass_tags' => ['shop' => 'car_repair'], 'icon' => 'car', 'sort_order' => 90],
            ['name' => 'Autohäuser', 'slug' => 'autohaus', 'overpass_tags' => ['shop' => 'car'], 'icon' => 'car', 'sort_order' => 91],

            // Sonstige
            ['name' => 'Fotografen', 'slug' => 'fotograf', 'overpass_tags' => ['craft' => 'photographer'], 'icon' => 'camera', 'sort_order' => 100],
            ['name' => 'Architekten', 'slug' => 'architekt', 'overpass_tags' => ['office' => 'architect'], 'icon' => 'pen-tool', 'sort_order' => 101],
            ['name' => 'Reinigung', 'slug' => 'reinigung', 'overpass_tags' => ['craft' => 'cleaner'], 'icon' => 'sparkles', 'sort_order' => 102],
            ['name' => 'Kinderbetreuung', 'slug' => 'kita', 'overpass_tags' => ['amenity' => 'kindergarten'], 'icon' => 'baby', 'sort_order' => 103],
            ['name' => 'Schulen', 'slug' => 'schule', 'overpass_tags' => ['amenity' => 'school'], 'icon' => 'graduation-cap', 'sort_order' => 104],
        ];

        foreach ($industries as $i) {
            Industry::updateOrCreate(['slug' => $i['slug']], [
                'name' => $i['name'],
                'slug' => $i['slug'],
                'overpass_tags' => json_encode($i['overpass_tags']),
                'icon' => $i['icon'],
                'is_active' => true,
                'sort_order' => $i['sort_order'],
            ]);
        }
    }
}
