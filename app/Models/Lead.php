<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'search_id',
        'guest_score_id',
        'industry_id',
        'name',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'source_url',
        'source_type',
        'has_website',
        'has_email',
        'has_phone',
        'has_address',
        'has_name',
        'website_valid',
        'ip_address',
        'consent_given',
        'consent_text',
        'email_verified_at',
        'verification_token',
        'notes',
        'status',
    ];

    protected $casts = [
        'has_website' => 'boolean',
        'has_email' => 'boolean',
        'has_phone' => 'boolean',
        'has_address' => 'boolean',
        'has_name' => 'boolean',
        'website_valid' => 'boolean',
        'consent_given' => 'boolean',
        'email_verified_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function search(): BelongsTo
    {
        return $this->belongsTo(Search::class);
    }

    public function guestScore(): BelongsTo
    {
        return $this->belongsTo(GuestScore::class);
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function markAsVerified(): void
    {
        $this->forceFill([
            'email_verified_at' => now(),
            'verification_token' => null,
        ])->save();
    }

    public function generateVerificationToken(): string
    {
        $token = \Illuminate\Support\Str::random(64);
        $this->forceFill(['verification_token' => $token])->save();
        return $token;
    }

    public function scopeWithWebsite($query)
    {
        return $query->where('has_website', true);
    }

    public function scopeWithEmail($query)
    {
        return $query->where('has_email', true);
    }

    public function scopeWithPhone($query)
    {
        return $query->where('has_phone', true);
    }

    public function scopeWithName($query)
    {
        return $query->where('has_name', true);
    }

    public function scopeValidated($query)
    {
        return $query->where('website_valid', true);
    }

    public static function csvHeader(): array
    {
        return [
            'Name', 'Email', 'Telefon', 'Webseite',
            'Adresse', 'Stadt', 'PLZ', 'Land',
            'Branche', 'Quelle', 'Website OK', 'Status'
        ];
    }

    public function toCsvRow(): array
    {
        return [
            $this->name,
            $this->email,
            $this->phone,
            $this->website,
            $this->address,
            $this->city,
            $this->postal_code,
            $this->country,
            $this->industry?->name ?? '',
            $this->source_type,
            $this->website_valid ? 'Ja' : 'Nein',
            $this->status,
        ];
    }
}
