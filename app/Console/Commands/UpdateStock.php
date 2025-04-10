<?php

namespace App\Console\Commands;

use App\Models\VCST\FormulaProd;
use App\Models\VCST\FormulaRefProd;
use App\Models\VCST\FormulaStock;
use App\Models\VCST\FormulaWhouse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stock {whs?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'อัพเดทข้อมูล Stcok';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $whs = FormulaWhouse::where('FCCODE', Str::trim($this->argument('whs')))->frist();
        // $prods = FormulaProd::whereIn('FCTYPE', array('1', '5', '9'))->orderBy('FCCODE')->get();
        // if ($whs) {
        //     foreach ($prods as $p) {
        //         $iQty = 0;
        //         $iProd = FormulaRefProd::where([
        //             'FCPROD' => trim($p->FCSKID),
        //             'FCWHOUSE' => trim($whs->fcskid),
        //             'FCIOTYPE' => "I",
        //         ])
        //             ->whereNotIn('FCSTAT', ['C'])->sum('FNQTY');
        //         if ($iProd) {
        //             $iQty = (int)$iProd;
        //         }

        //         $oQty = 0;
        //         $oProd = FormulaRefProd::where([
        //             'FCPROD' => trim($p->FCSKID),
        //             'FCWHOUSE' => trim($whs->FCSKID),
        //             'FCIOTYPE' => "O"
        //         ])
        //             ->whereNotIn('FCSTAT', ['C'])->sum('FNQTY');
        //         if ($oProd) {
        //             $oQty = (int)$oProd;
        //         }

        //         $sumQty = $iQty - $oQty;
        //         FormulaStock::updateOrCreate([
        //             'FCPROD' => trim($p->FCSKID),
        //             'FCWHOUSE' => trim($whs->FCSKID),
        //         ], [
        //             'FCDATASER' => '$$$+',
        //             'FCLUPDAPP' => '$0',
        //             'FCCORP' => 'H2ZFEv02',
        //             'FCBRANCH' => 'H2Z2kf01',
        //             'FCWHOUSE' => trim($whs->FCSKID), //'{str(w['FCSKID']).strip()}',
        //             'FCPROD' => trim($p->FCSKID), //'{str(r[0])}',
        //             'FDDATE' => now()->format('Y-m-d'), //GETDATE(),
        //             'FNAVGCOST' => 0, //0,
        //             'FNQTY' => $sumQty, //0,
        //             'FNSTQTYSTD' => 0, //0,
        //             'FNPRICE' => $p->FNPRICE, //0,
        //             'FNEDPRICE' => 0, //0,
        //             'FCEAFTERR' => 'E', //'E',
        //             'FNDOQTY' => 0, //0,
        //             'FNGRNQTY' => 0, //0,
        //             'FIMILLISEC' => now()->getTimestamp(), //
        //             'FTLASTUPD' => now(), //GETDATE(),
        //             'FTLASTEDIT' => now(), //GETDATE(),
        //             'FNALLOCQTY' => 0, //0,
        //             'FCCREATEAP' => '$0',
        //             'FCCREATEBY' => 'RezObD03',
        //             'FCCORRECTB' => 'RezObD03',
        //             'FNU1CNT' => 0,
        //             'FNU2CNT' => 0,
        //             'FNU3CNT' => 0,
        //             'FNU4CNT' => 0,
        //             'FNU5CNT' => 0,
        //             'FNU6CNT' => 0,
        //             'FNU7CNT' => 0,
        //             'FNU8CNT' => 0,
        //             'FNU9CNT' => 0,
        //         ]);
        //         unset($sumQty);
        //     }
        // }
    }
}
