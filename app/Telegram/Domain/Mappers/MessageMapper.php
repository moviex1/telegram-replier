<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Mappers;

use App\Telegram\Domain\DTO\Message\MessageDTO;
use App\Telegram\Domain\Models\Message;

final readonly class MessageMapper
{
    public function fromModel(Message $message): MessageDTO
    {
        return new MessageDTO(
            messageId: $message->message_id,
            chatId: $message->chat_id,
            text: $message->text,
            id: $message->id,
        );
    }

    public function toModel(MessageDTO $messageDTO): Message
    {
        $message = new Message;

        $message->message_id = $messageDTO->messageId;
        $message->chat_id = $messageDTO->chatId;
        $message->text = $messageDTO->text;

        return $message;
    }
}
