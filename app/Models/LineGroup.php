<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LineGroup extends Model
{
    use HasFactory, Notifiable, HasUlids;

    protected $fillable = [
        'group_id',
        'user_id',
        'name',
        'description',
        'is_active',
    ];
}
