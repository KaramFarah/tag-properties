<?php

namespace App\Console\Commands;

use App\Models\Dashboard\Tag;
use Illuminate\Console\Command;

class TagsMassUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags:mass-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all Tags giving them values to thier slug\'s column';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tags = Tag::all();
        foreach($tags as $tag){
            $tag->update();
        }
        $this->info('Success: All tags were updated');
    }
}
