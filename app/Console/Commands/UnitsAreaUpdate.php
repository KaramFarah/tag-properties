<?php

namespace App\Console\Commands;

use App\Models\Dashboard\Unit;
use Illuminate\Console\Command;

class UnitsAreaUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:units-area-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $units = Unit::whereNull('area_sqft')->get();
        foreach($units as $unit){
            $unit->update(['area_sqft' => 0]);
        }
        $bed_units = Unit::whereNull('bedrooms')->get();
        foreach($bed_units as $bed_unit){
            $bed_unit->update(['bedrooms' => 1]);
        }
        $bath_units = Unit::whereNull('bathrooms')->get();
        foreach($bath_units as $bath_unit){
            $bath_unit->update(['bathrooms' => 1]);
        }
        $this->info('success: all Units were updated');
    }
}
