<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estimate;

class CheckEstimates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:estimates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check estimate expire';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $estimates = Estimate::where('expire_date', '<', date("Y-m-d"))->get();
        foreach($estimates as $estimate){
            $estimate->status = 3;
            $estimate->save();
        }
    }
}
