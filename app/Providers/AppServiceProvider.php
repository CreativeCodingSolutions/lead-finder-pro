<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // NOTE: Do NOT use URL::forceScheme('https') here.
        // Traefik terminates TLS and forwards HTTP to this container.
        // Forcing HTTPS in the app layer causes redirect loops / 502 errors
        // when the proxy itself speaks HTTP on the backend connection.
        // TrustProxies middleware handles X-Forwarded-* headers correctly.
    }
}
