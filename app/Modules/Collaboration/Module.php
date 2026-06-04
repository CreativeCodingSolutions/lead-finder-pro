<?php

namespace App\Modules\Collaboration;

class Module
{
    public static function isEnabled(): bool
    {
        return env('FEATURE_COLLABORATION', false);
    }

    public static function boot()
    {
        if (!self::isEnabled()) return;
        // Collaboration-specific boot logic
    }
}
