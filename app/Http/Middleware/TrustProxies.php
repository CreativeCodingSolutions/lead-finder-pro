<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Use specific IP addresses or CIDR ranges instead of wildcard '*'
     * to prevent IP spoofing attacks. Configure via TRUSTED_PROXIES env var
     * (comma-separated), e.g. "10.0.0.0/8,172.16.0.0/12,192.168.0.0/16"
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
        if (!empty($configured)) {
            $this->proxies = array_map('trim', explode(',', $configured));
        } else {
            // No proxies trusted by default — safe fallback
            $this->proxies = [];
        }
    }
}
