<?php

namespace App\Http\Controllers\Website;

use Share;
use Illuminate\Http\Request;
use App\Models\Dashboard\Project;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Dashboard\BaseController;

class ProjectsWebsiteController extends BaseController
{
    public function index(){
        
        $query = Project::orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->with('media', 'developers' , 'units' , 'Ranges' , 'places' , 'installments');

        $query->when(request()->get('sKeyword') , function($q){
            $q->where('name' , 'like' , "%" . request()->get('sKeyword') . "%");
        });
        $query->when(request()->get('city') , function($q){
            $q->where('community' , 'like' , "%" . request()->get('city') . "%" );
        });
        $query->when(request()->get('status') , function($q){
            $q->where('status' , request()->get('status'));
        });

        $query->when(request()->get('price') , function($q){
            $minPrice = (int) explode(';' , request()->get('price'))[0];
            $maxPrice = (int) explode(';' , request()->get('price'))[1];
            if($minPrice != 0){
                $q->whereRelation('ranges' , 'min_price' , '>=' , $minPrice);
            }
            if($maxPrice != 5000000){
                $q->whereRelation('ranges' , 'min_price' , '<=' , $maxPrice);
            }
        });
        $query->when(request()->get('min_size') , function($q){
            $minSize = (int) request()->get('min_size');
            $q->whereRelation('ranges' , 'min_size' , '>=' , $minSize);
        });
        $query->when(request()->get('max_size') , function($q){
            $maxSize = (int) request()->get('max_size');
            $q->whereRelation('ranges' , 'min_size' , '<=' , $maxSize);
        });

        $statuses = $this->getPropertyStatuses();

        
        $projects = $query->paginate(10)->withQueryString();

        $recentProjects = Project::latest()->limit(5)->get();

        $local_title = __('Projects');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.projects-list', compact( 'projects', 'local_title', 'local_description', 'breadcrumbs', 'recentProjects', 'statuses'));
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
