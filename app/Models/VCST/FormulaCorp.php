<?php

namespace App\Models\VCST;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormulaCorp extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'vcst';

    protected $table = 'CORP';

    protected $primaryKey = 'FCSKID'; // or null

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'FCCODE',
        'FCRFTYPE',
        'FCNAME',
        'FCNAME2',
        'FNCREDTERM'
    ];
}
