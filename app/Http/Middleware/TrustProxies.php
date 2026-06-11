<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Supports:
     *   - "*"  (trust all proxies — use only behind controlled reverse proxy like Traefik)
     *   - Comma-separated IPs/CIDRs, e.g. "10.0.0.0/8,172.16.0.0/12"
     *
     * @var array|string|null
     */
    protected $proxies;

    protected $headers = Request::HEADER_X_FORWARDED_FOR
        | Request::HEADER_X_FORWARDED_HOST
        | Request::HEADER_X_FORWARDED_PORT
        | Request::HEADER_X_FORWARDED_PROTO
        | Request::HEADER_X_FORWARDED_AWS_ELB;

    public function __construct()
    {
        $configured = env('TRUSTED_PROXIES', '');
        if ($configured === '*') {
            // Trust all proxies (safe when behind controlled reverse proxy like Traefik)
            $this->proxies = '*';
        } elseif (!empty($configured)) {
            // Parse comma-separated list of IPs/CIDRs
            $this->proxies = array_map('trim', explode(',', $configured));
        } else {
            // No proxies trusted by default — safe fallback
            $this->proxies = [];
        }
    }
}
