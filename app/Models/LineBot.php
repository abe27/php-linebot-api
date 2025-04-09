<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LineBot extends Model
{
    use HasFactory, Notifiable, HasUlids;

    protected $fillable = [
        'handle_date',
        'line_user_id',
        'message_source',
        'line_group_id',
        'message_type',
        'message',
        'reply_token',
        'is_replyed',
    ];
}
