<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Message;

use App\Telegram\Domain\DTO\MessageDTO;
use App\Telegram\Domain\Mapper\MessageMapper;
use App\Telegram\Domain\Models\Message;

final readonly class GetMessagesService
{
    public function __construct(
        private MessageMapper $messageMapper,
    ){}

    /** @return MessageDTO[] */
    public function __invoke(int $perPage): array
    {
        $messages = Message::query()
            ->paginate($perPage)
            ->items();

        $result = [];
        foreach ($messages as $message) {
            $result[] = $this->messageMapper->fromModel($message);
        }
        unset($messages);

        return $result;
    }
}
