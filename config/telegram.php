<?php

declare(strict_types=1);

return [
    'bot-token' => env('TELEGRAM_BOT_TOKEN'),
    'updates-limit' => env('TELEGRAM_UPDATES_LIMIT', 10),
];
