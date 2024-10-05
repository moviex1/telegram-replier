<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class GetMessagesRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'perPage' => ['integer', 'min:1','max:100']
        ];
    }
}
