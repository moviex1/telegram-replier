<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Telegram;

use App\Telegram\Domain\DTO\Telegram\SendMessageDTO;
use App\Telegram\Infrastructure\Telegram\Client\Client as TelegramClient;
use App\Telegram\Infrastructure\Telegram\Client\ClientFactory;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Http\Client\ConnectionException;

final readonly class SendMessageService
{
    private TelegramClient $telegramClient;
    public function __construct(
        ClientFactory $telegramClientFactory,
    ) {
        $this->telegramClient = $telegramClientFactory->create(config('telegram.bot-token'));
    }

    /**
     * @throws InvalidTelegramResponse
     * @throws ConnectionException
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
