<?php

declare(strict_types=1);

namespace App\Telegram\Infrastructure\UpdateTracker;

use App\Telegram\Domain\Interfaces\UpdateTrackerInterface;
use Illuminate\Support\Facades\Cache;

final readonly class CacheUpdateTracker implements UpdateTrackerInterface
{

    public function getLastUpdateId(): int
    {
        return Cache::get('updateId') ?? 0;
    }

    public function setLastUpdateId(int $updateId): void
    {
        Cache::set('updateId', $updateId);
    }
}
