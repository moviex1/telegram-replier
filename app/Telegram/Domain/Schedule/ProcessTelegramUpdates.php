<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Schedule;

use App\Telegram\Domain\Jobs\ProcessUpdate;
use App\Telegram\Domain\Services\Telegram\GetUpdatesService;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;

final readonly class ProcessTelegramUpdates
{
    public function __construct(
        private GetUpdatesService $getUpdatesService,
    ) {}

    /**
     * @throws InvalidTelegramResponse
     * @throws \Throwable
     */
    public function __invoke(): void
    {
        $updates = $this->getUpdatesService->__invoke();
        foreach ($updates as $update) {
            ProcessUpdate::dispatch($update);
        }
    }
}
