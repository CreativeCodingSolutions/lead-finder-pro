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
        'stripe_status',
        'plan',
        'trial_ends_at',
        'plan_ends_at',
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
        'trial_ends_at' => 'datetime',
        'plan_ends_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): ?Subscription
    {
        return $this->subscriptions()
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })
            ->latest('current_period_end')
            ->first();
    }

    public function isPro(): bool
    {
        return in_array($this->plan, ['pro', 'business', 'agency']) &&
               ($this->plan_ends_at === null || $this->plan_ends_at->isFuture());
    }

    public function isBusiness(): bool
    {
        return in_array($this->plan, ['business', 'agency']) &&
               ($this->plan_ends_at === null || $this->plan_ends_at->isFuture());
    }

    public function isAgency(): bool
    {
        return $this->plan === 'agency' &&
               ($this->plan_ends_at === null || $this->plan_ends_at->isFuture());
    }
}
