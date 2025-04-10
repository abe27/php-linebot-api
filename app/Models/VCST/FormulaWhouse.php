<?php

namespace App\Models\VCST;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class FormulaWhouse extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'vcst';

    protected $table = 'WHOUSE';

    protected $primaryKey = 'FCSKID'; // or null

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'FCCORP',
        'FCBRANCH',
        'FCCODE',
        'FCNAME',
        'FCNAME2',
    ];

    public function corp()
    {
        return $this->belongsTo(FormulaCorp::class, 'FCCORP', 'FCSKID');
    }

    // public function branch()
    // {
    //     return $this->belongsTo(Branch::class, 'FCBRANCH', 'FCSKID');
    // }
}
