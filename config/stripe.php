<?php

return [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'price_pro' => env('STRIPE_PRICE_PRO'),
    'price_business' => env('STRIPE_PRICE_BUSINESS'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
];
