<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'stripe_id',
        'plan',
        'plan_expires_at',
        'reports_limit',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
        'plan_expires_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function isPro(): bool
    {
        return in_array($this->plan, ['pro', 'business']) && 
               ($this->plan_expires_at === null || $this->plan_expires_at->isFuture());
    }

    public function isBusiness(): bool
    {
        return $this->plan === 'business' && 
               ($this->plan_expires_at === null || $this->plan_expires_at->isFuture());
    }
}
