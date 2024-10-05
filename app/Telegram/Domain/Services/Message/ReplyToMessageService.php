<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Message;

use App\Telegram\Domain\DTO\Telegram\SendMessageDTO;
use App\Telegram\Domain\Exceptions\RecordNotFound;
use App\Telegram\Domain\Jobs\SendMessage;
use App\Telegram\Domain\Models\Message;

final readonly class ReplyToMessageService
{
    public function __construct(
    ){}

    /**
     * @throws RecordNotFound
     */
    public function __invoke(int $messageId, string $text): void
    {
        /** @var null|Message $message */
        $message = Message::query()->find($messageId);

        if ($message === null) {
            throw new RecordNotFound("Message with id $messageId not found");
        }

        SendMessage::dispatch(new SendMessageDTO(
            text: $text,
            chatId: $message->chat_id,
            replyToId: $message->message_id,
        ));
    }
}
