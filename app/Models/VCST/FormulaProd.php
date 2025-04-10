<?php

namespace App\Models\VCST;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormulaProd extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'vcst';

    protected $table = 'PROD';

    protected $primaryKey = 'FCSKID'; // or null

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'FCSKID',
        'FCCORP',
        'FCTYPE',
        'FCPDGRP',
        'FCBRANCH',
        'FCCODE',
        'FCNAME',
        'FCNAME2',
        'FCSNAME',
        'FCSNAME2',
        'FNAVGCOST',
        'FNSTDCOST',
        'FCUM',
        'FNPRICE',
        'FCACCBCRED',
    ];
}
