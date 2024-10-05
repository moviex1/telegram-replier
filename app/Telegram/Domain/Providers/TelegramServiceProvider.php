<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Providers;

use App\Telegram\Domain\Interfaces\UpdateTrackerInterface;
use App\Telegram\Infrastructure\UpdateTracker\CacheUpdateTracker;
use Illuminate\Support\ServiceProvider;

final class TelegramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UpdateTrackerInterface::class, CacheUpdateTracker::class);
    }
}
