<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Domain\Services\Telegram;

use App\Telegram\Domain\DTO\Telegram\SendMessageDTO;
use App\Telegram\Domain\Services\Telegram\SendMessageService;
use App\Telegram\Infrastructure\Telegram\Client\Client;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class SendMessageServiceTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidTelegramResponse
     */
    public function testService(): void
    {
        $telegramClient = $this->createMock(Client::class);
        $telegramClient->expects($this->once())
            ->method('send')
            ->with('sendMessage', [
                'chat_id' => 1,
                'text' => 'test',
                'reply_parameters' => [
                    'message_id' => 1,
                ],
            ]);

        $sendMessageService = new SendMessageService($telegramClient);
        $sendMessageService(new SendMessageDTO(
            text: 'test',
            chatId: 1,
            replyToId: 1,
        ));
    }
}
