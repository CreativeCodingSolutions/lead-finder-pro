<?php

namespace App\Modules\Billing;

class Module
{
    public static function name(): string
    {
        return 'Billing';
    }

    public static function enabled(): bool
    {
        return env('FEATURE_BILLING', false);
    }
}
