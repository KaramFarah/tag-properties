<?php

namespace App\Console\Commands;

use App\Models\Dashboard\Unit;
use Illuminate\Console\Command;

class UnitsMassUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'units:mass-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all Units giving them values to thier slug\'s column';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $units = Unit::where('slug' , null)->get();
        foreach($units as $unit){
            $unit->update([]);
        }
        $this->info('success: all Units were updated');
    }
}
