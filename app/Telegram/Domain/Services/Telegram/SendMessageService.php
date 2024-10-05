<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Telegram;

use App\Telegram\Domain\DTO\Telegram\SendMessageDTO;
use App\Telegram\Infrastructure\Telegram\Client\Client as TelegramClient;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;

final readonly class SendMessageService
{
    public function __construct(
        private TelegramClient $telegramClient,
    )
    {
    }

    /**
     * @throws InvalidTelegramResponse
     */
    public function __invoke(SendMessageDTO $sendMessageDTO): void
    {
        $data = [
            'chat_id' => $sendMessageDTO->chatId,
            'text' => $sendMessageDTO->text,
        ];

        if ($sendMessageDTO->replyToId !== null) {
            $data['reply_parameters']['message_id'] = $sendMessageDTO->replyToId;
        }

        $this->telegramClient->send('sendMessage', $data);
    }
}
