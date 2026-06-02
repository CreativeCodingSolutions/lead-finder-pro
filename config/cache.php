<?php

return [
    'driver' => env('CACHE_DRIVER', 'file'),
    'prefix' => env('CACHE_PREFIX', 'leadfinder_'),
    'stores' => [
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],
    ],
];
