<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Common\Infrastructure\Controller;
use App\Telegram\Application\Http\Requests\ReplyToMessageRequest;
use App\Telegram\Domain\Exceptions\RecordNotFound;
use App\Telegram\Domain\Services\Message\ReplyToMessageService;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ReplyToMessageController extends Controller
{
    /**
     * @throws InvalidTelegramResponse
     * @throws RecordNotFound
     */
    public function __invoke(
        int $messageId,
        ReplyToMessageRequest $request,
        ReplyToMessageService $replyToMessageService,
    ): JsonResponse
    {
        $replyToMessageService($messageId, $request->string('text')->toString());

        return $this->success();
    }
}
