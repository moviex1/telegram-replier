<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Common\Infrastructure\Controller;
use App\Telegram\Application\Http\Requests\ReplyToMessageRequest;
use App\Telegram\Domain\Exceptions\RecordNotFound;
use App\Telegram\Domain\Services\Message\ReplyToMessageService;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/messages/{messageId}/reply',
    description: 'Reply to a message',
    requestBody: new OA\RequestBody(ref: '#/components/requestBodies/ReplyToMessageRequest'),
    tags: ['Message'],
    parameters: [new OA\Parameter(name: 'messageId', in: 'path', schema: new OA\Schema(type: 'integer', default: 10, example: 10))],
    responses: [
        new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'success', type: 'boolean', default: true),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items, example: []),
                new OA\Property(property: 'message', type: 'string', default: 'some message', nullable: true),
            ],
            type: 'object'
        )),
        new OA\Response(response: 404, description: 'Not Found', content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'success', type: 'boolean', default: false),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items, example: []),
                new OA\Property(property: 'message', type: 'string', default: 'some message', nullable: true),
            ],
            type: 'object'
        )),
        new OA\Response(response: 422, description: 'Unprocessable Entity', content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'success', type: 'boolean', default: false),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items, example: []),
                new OA\Property(property: 'message', type: 'string', default: 'some message', nullable: true),
            ],
            type: 'object'
        )),
    ],
)]
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
    ): JsonResponse {
        $replyToMessageService($messageId, $request->string('text')->toString());

        return $this->success();
    }
}
