<?php

declare(strict_types=1);

namespace Tests\Unit\Telegram\Application\Http\Controllers\Messages;

use App\Telegram\Application\Http\Controllers\Messages\GetMessagesController;
use App\Telegram\Application\Http\Requests\GetMessagesRequest;
use App\Telegram\Domain\Services\Message\GetMessagesService;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tests\TestCase;

class GetMessagesControllerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testController()
    {
        $getMessagesService = $this->createMock(GetMessagesService::class);
        $getMessagesService->expects($this->once())
            ->method('__invoke');

        $controller = new GetMessagesController();
        $response = $controller(new GetMessagesRequest(query: ['perPage' => 10]), $getMessagesService);

        self::assertInstanceOf(JsonResponse::class, $response);
        $json = $response->getData();

        self::assertTrue($json->success);
    }
}
