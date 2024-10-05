<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Common\Infrastructure\Controller;
use App\Telegram\Application\Http\Requests\GetMessagesRequest;
use App\Telegram\Domain\Services\Message\GetMessagesService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/messages',
    description: 'Get a list of all messages.',
    tags: ['Message'],
    parameters: [new OA\Parameter(name: 'perPage', in: 'query', schema: new OA\Schema(type: 'integer', default: 10, example: 10))],
    responses: [
        new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'success', type: 'boolean', default: true),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Message')),
                new OA\Property(property: 'message', type: 'string', default: 'some message', nullable: true),
            ],
            type: 'object'
        ))
    ],
)]
final class GetMessagesController extends Controller
{
    public function __invoke(
        GetMessagesRequest $request,
        GetMessagesService $getMessagesService,
    ): JsonResponse
    {
        return $this->success(
            data: $getMessagesService($request->integer('perPage', 10))
        );
    }
}
