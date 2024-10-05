<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Common\Infrastructure\Controller;
use App\Telegram\Domain\Services\Message\GetMessagesService;
use Illuminate\Http\JsonResponse;

final class GetMessagesController extends Controller
{
    public function __invoke(GetMessagesService $getMessagesService): JsonResponse
    {
        return $this->success($getMessagesService(10));
    }
}
