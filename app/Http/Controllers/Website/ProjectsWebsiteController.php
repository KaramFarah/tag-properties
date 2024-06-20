<?php

namespace App\Http\Controllers\Website;

use Share;
use Illuminate\Http\Request;
use App\Models\Dashboard\Project;
use App\Http\Controllers\Dashboard\BaseController;

class ProjectsWebsiteController extends BaseController
{
    public function index(){
        
        $query = Project::orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->with('media', 'developers' , 'units' , 'Ranges' , 'places' , 'installments');
        
        if(request()->query('city')){
            $cityId = request()->get('city');
            $query->whereHas('cities', function($q) use ($cityId) {
                $q->where('city_id', $cityId);
            });
        }

        $statuses = $this->getPropertyStatuses();
    
        if($sStatus = request()->query('status')){
            $query->where('status' , $sStatus);
        }
        
        $projects = $query->paginate(20);

        $recentProjects = Project::latest()->limit(5)->get();

        $local_title = __('Projects');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.projects-list', compact( 'projects', 'local_title', 'local_description', 'breadcrumbs', 'recentProjects', 'sStatus', 'statuses'));
    }

    public function show(Project $project)
    {        
        $recentProjects = Project::latest()->limit(5)->get();

        $shareLink = Share::page(route('propertyShow' , ['unit' => $project->slug]) , $project->name . ' | ' . config('panel.website_title'))
        ->facebook()
        ->whatsapp()
        ->telegram()
        ->twitter()
        ->getRawLinks();

        $local_title = __($project->name);
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('Projects'), 'url' => route('projects.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.project-single', compact( 'recentProjects', 'shareLink', 'project', 'local_title', 'breadcrumbs'));
    }
}
