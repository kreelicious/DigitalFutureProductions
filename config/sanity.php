<?php

return [
    'project_id' => env('SANITY_PROJECT_ID'),
    'dataset' => env('SANITY_DATASET', 'production'),
    'api_version' => env('SANITY_API_VERSION', '2024-01-01'),
    'token' => env('SANITY_TOKEN'), // optional
];