<?php

return [
    'driver' => env('RECOMMENDATION_DRIVER', 'gemini'),

    'drivers' => [
        'gemini' => \App\Services\Drivers\GeminiDriver::class,
        // 'openai' => \App\Services\Drivers\OpenAIDriver::class,
        // 'claude' => \App\Services\Drivers\ClaudeDriver::class,
    ],
];
