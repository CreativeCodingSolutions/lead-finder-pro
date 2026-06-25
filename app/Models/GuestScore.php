<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestScore extends Model
{
    protected $fillable = [
        'uuid', 'url', 'industry_name', 'city', 'country',
        'lead_count', 'score', 'sample_leads', 'ip_address', 'lead_captured',
    ];

    protected $casts = [
        'sample_leads' => 'array',
        'lead_count' => 'integer',
        'score' => 'integer',
        'lead_captured' => 'boolean',
    ];

    /**
     * Calculate a deterministic quality score based on lead count and data completeness.
     */
    public static function calculateScore(int $leadCount, array $sampleLeads): int
    {
        $base = 40;

        // Bonus for lead count (more leads = better data availability)
        if ($leadCount >= 5) $base += 20;
        elseif ($leadCount >= 3) $base += 10;

        // Bonus for data completeness across samples
        $hasWebsite = 0;
        $hasPhone = 0;
        $hasAddress = 0;
        foreach ($sampleLeads as $lead) {
            if (!empty($lead['website'])) $hasWebsite++;
            if (!empty($lead['phone'])) $hasPhone++;
            if (!empty($lead['address'])) $hasAddress++;
        }

        $total = count($sampleLeads) ?: 1;
        $base += (int) (($hasWebsite / $total) * 10);
        $base += (int) (($hasPhone / $total) * 10);
        $base += (int) (($hasAddress / $total) * 10);

        // Hash-based subtle variation for uniqueness
        $hash = crc32(json_encode($sampleLeads));
        $variation = ($hash % 11) - 5;

        return max(0, min(100, $base + $variation));
    }
}
