<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Interfaces;

interface UpdateTrackerInterface
{
    public function getLastUpdateId(): int;
    public function setLastUpdateId(int $updateId): void;
}
