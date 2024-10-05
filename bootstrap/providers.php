<?php

use App\Common\Infrastructure\Providers\AppServiceProvider;
use App\Telegram\Domain\Providers\TelegramServiceProvider;

return [
    AppServiceProvider::class,
    TelegramServiceProvider::class,
];
