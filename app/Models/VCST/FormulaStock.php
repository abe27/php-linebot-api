<?php

namespace App\Models\VCST;

use App\Traits\Nanoid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormulaStock extends Model
{
    use HasFactory, Notifiable, Nanoid;

    protected $connection = 'vcst';

    protected $table = 'STOCK';

    protected $primaryKey = 'FCSKID'; // or null

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'FCSKID', //'{generate(size=8)}',
        'FCDATASER', //'$$$+',
        'FCLUPDAPP', //'$0',
        'FCCORP', //'H2ZFEv02',
        'FCBRANCH', //'H2Z2kf01',
        'FCWHOUSE', //'{str(w['FCSKID']).strip()}',
        'FCPROD', //'{str(r[0])}',
        'FDDATE', //GETDATE(),
        'FNAVGCOST', //0,
        'FNQTY', //0,
        'FNSTQTYSTD', //0,
        'FNPRICE', //0,
        'FNEDPRICE', //0,
        'FCEAFTERR', //'E',
        'FNDOQTY', //0,
        'FNGRNQTY', //0,
        'FIMILLISEC', //0
        'FTLASTUPD', //GETDATE(),
        'FTLASTEDIT', //GETDATE(),
        'FNALLOCQTY', //0,
        'FCCREATEAP', //'$0',
        'FCCREATEBY', //'1440',
        'FCCORRECTB', //'RezObD03',
        'FNU1CNT', //0,
        'FNU2CNT', //0,
        'FNU3CNT', //0,
        'FNU4CNT', //0,
        'FNU5CNT', //0,
        'FNU6CNT', //0,
        'FNU7CNT', //0,
        'FNU8CNT', //0,
        'FNU9CNT', //0)
    ];

    public function warehouse()
    {
        return $this->belongsTo(FormulaWhouse::class, 'FCWHOUSE', 'FCSKID');
    }

    public function product()
    {
        return $this->belongsTo(FormulaProd::class, 'FCPROD', 'FCSKID');
    }

    public function corp()
    {
        return $this->belongsTo(FormulaCorp::class, 'FCCORP', 'FCSKID');
    }
}
