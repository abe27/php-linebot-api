<?php

namespace App\Models\VCST;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormulaRefProd extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'vcst';

    protected $table = 'REFPROD';

    protected $primaryKey = 'FCSKID'; // or null

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'FCBRANCH', //
        'FCCOOR', //
        'FCCORP', //
        'FCCREATEAP', // $0
        'FCCREATEBY', // 14500
        'FCDATASER', // $$$9
        'FCDEPT', // H2ZFcP04
        'FCEAFTERR', // E
        'FCFORMULAS', // null
        'FCGL', // null
        'FCGLHEAD', //
        'FCGLREF', //
        'FCIOTYPE', // default = I for in ,for out = O
        'FCJOB', //
        'FCLUPDAPP', // $0
        'FCPFORMULA', // null
        'FCPROD', //
        'FCPRODTYPE', //
        'FCPROJ', //
        'FCREFPDTYP', // P
        'FCREFTYPE', // BI
        'FCRFTYPE', // B
        'FCROOTSEQ', // 01
        'FCSECT', //
        'FCSEQ', // 01
        'FCSKID', // nanoid generate size 8
        'FCSTUM', // reference FormulaUm
        'FCSTUMSTD', // reference FormulaUm
        'FCUM', // reference FormulaUm
        'FCUMSTD', // reference FormulaUm
        'FCWHOUSE', // reference FormulaWhouse
        'FDDATE', // now()->format('Y-m-d')
        'FDDELIVERY', // null
        'FIMILLISEC', // now()->timestamp
        'FMREMARK', // Remark or Description
        'FNCOMMISSI', // 0
        'FNCOST', // 0
        'FNCOSTADJ', // 0
        'FNCOSTAMT', // 0
        'FNCOSTAVG', // 0
        'FNCOSTFIFO', // 0
        'FNCOSTLOT', // 0
        'FNCOSTSTD', // 0
        'FNDEFAPRIC', // 0
        'FNDISCAMT', // 0
        'FNDISCAMTK', // 0
        'FNDISCPCN', // 0
        'FNPAYAMT', // 0
        'FNPAYAMTKE', // 0
        'FNPRICE', // 0
        'FNPRICEKE', // 0
        'FNPRODAGE', // 0
        'FNQTY', // 0
        'FNQTYATDAT', // 0
        'FNREFQTY', // 0
        'FNSTQTY', // 0
        'FNSTUMQTY', // 0
        'FNUMQTY', // 0
        'FNVATAMT', // 0
        'FNVATPORT', // 0
        'FNVATPORTA', // 0
        'FNVATRATE', // 0
        'FNWTAXAMT', // 0
        'FNWTAXAMTK', // 0
        'FNWTAXRATE', // 0
        'FNXRATE', // 0
        'FTDATETIME', // now()
        'FTLASTUPD', // now()
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
