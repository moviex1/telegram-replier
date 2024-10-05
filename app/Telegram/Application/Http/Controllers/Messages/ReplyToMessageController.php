<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Common\Infrastructure\Controller;
use Illuminate\Http\JsonResponse;

final class ReplyToMessageController extends Controller
{
    public function __invoke(int $messageId, ): JsonResponse
    {
        return $this->success();
    }
}
