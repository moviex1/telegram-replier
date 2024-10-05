<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [];
}
