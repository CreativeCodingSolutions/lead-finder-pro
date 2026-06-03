<?php

return [
    'enabled' => env('FEATURE_EXPORT_SCHEDULER', false),
    'name' => 'Export Scheduler',
    'description' => 'Automated lead export scheduling (daily, weekly, monthly)',
    'version' => '1.0.0',
];
