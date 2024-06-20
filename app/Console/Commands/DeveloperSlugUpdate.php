<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dashboard\Developer;

class DeveloperSlugUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:developer-slug-update';

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
        $developers = Developer::where('slug' , null)->get();
        foreach($developers as $developer){
            $developer->update([]);
        }
        $this->info('success: all developers were updated');
    }
}
