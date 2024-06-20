<?php

namespace App\Console\Commands;

use App\Models\Dashboard\Project;
use Illuminate\Console\Command;

class UpdateProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-projects';

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
        $projects = Project::all();
        foreach($projects as $project){
            if($project->type == 'sale') {
                $project->status = 2;
            }
            elseif($project->type == 'off-plan'){
                $project->status = 1;
            }
            else {
                $project->status = 0;
            }
            $project->type = '';
            
            $project->update();
        }
        $this->info('success: all Projects were updated');
    }
}
