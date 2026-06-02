<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'query',
        'industry_id',
        'city',
        'postal_code',
        'country',
        'radius_km',
        'filter_website',
        'filter_email',
        'filter_phone',
        'filter_name',
        'result_count',
        'status',
    ];

    protected $casts = [
        'filter_website' => 'boolean',
        'filter_email' => 'boolean',
        'filter_phone' => 'boolean',
        'filter_name' => 'boolean',
        'radius_km' => 'integer',
        'result_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
