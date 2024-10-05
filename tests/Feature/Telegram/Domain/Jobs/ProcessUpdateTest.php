<?php

declare(strict_types=1);

namespace Feature\Telegram\Domain\Jobs;

use App\Telegram\Domain\DTO\Telegram\UpdateDTO;
use App\Telegram\Domain\Jobs\ProcessUpdate;
use App\Telegram\Domain\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testProcessUpdate(): void
    {
        $updateDTO = new UpdateDTO(
            updateId: 1,
            messageId: 1,
            chatId: 2,
            text: 'asdf',
        );
        ProcessUpdate::dispatchSync($updateDTO);

        $message = $this->findMessageByMessageId($updateDTO->messageId);

        self::assertNotNull($message);
        self::assertInstanceOf(Message::class, $message);
    }

    private function findMessageByMessageId(int $messageId): ?Message
    {
        return Message::query()->where('message_id', $messageId)->get()->first();
    }
}
