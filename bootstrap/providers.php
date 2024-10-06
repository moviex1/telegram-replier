<?php

use App\Common\Infrastructure\Providers\AppServiceProvider;
use App\Telegram\Infrastructure\Providers\TelegramServiceProvider;

return [
    AppServiceProvider::class,
    TelegramServiceProvider::class,
];
