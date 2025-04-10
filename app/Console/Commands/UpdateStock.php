<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        $stock = $this->argument('whs');
        for ($i = 0; $i < 10000; $i++) {
            Log::info($i . ' Running At: ' . $stock);
        }
    }
}
