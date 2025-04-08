<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LineUser extends Model
{
    use HasFactory, Notifiable, HasUlids;

    protected $fillable = [
        'emp_id',
        'display_name',
        'user_id',
        'picture_url',
        'status_message',
        'language',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
