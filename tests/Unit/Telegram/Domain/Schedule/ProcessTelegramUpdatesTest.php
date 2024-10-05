<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Domain\Schedule;

use App\Telegram\Domain\DTO\Telegram\UpdateDTO;
use App\Telegram\Domain\Jobs\ProcessUpdate;
use App\Telegram\Domain\Schedule\ProcessTelegramUpdates;
use App\Telegram\Domain\Services\Telegram\GetUpdatesService;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class ProcessTelegramUpdatesTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidTelegramResponse
     * @throws \Throwable
     */
    public function testProcessingUpdates(): void
    {
        $queue = Queue::fake();

        $getUpdatesService = $this->createMock(GetUpdatesService::class);
        $getUpdatesService->expects($this->once())
            ->method('__invoke')
            ->willReturn([new UpdateDTO(updateId: 1, messageId: 1, chatId: 1, text: ''), new UpdateDTO(updateId: 2, messageId: 2, chatId: 2, text: '')]);

        $processTelegramUpdates = new ProcessTelegramUpdates($getUpdatesService);
        $processTelegramUpdates();

        $queue->assertPushedOn('process_updates', ProcessUpdate::class);
        $queue->assertCount(2);
    }
}
