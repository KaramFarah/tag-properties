<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use Share;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use Ramsey\Uuid\Type\Integer;
use App\Models\Dashboard\City;
use App\Helpers\DashboardHelper;
use App\Models\Dashboard\Project;
use App\Models\Dashboard\BaseModel;
use App\Models\Dashboard\Developer;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class BaseController extends Controller
{
    public string $template = '';
    public BaseModel $model;

    public $countries = [];
    
    public function __construct()
    {
        $this->countries = DashboardHelper::countries();

        $this->template = config('panel.template');
        view()->share('menuItems', DashboardHelper::getMenuItems());
        view()->share('project_count', Project::all()->count());
    }

    public function getTags($type = '' , $isSlug = false)
    {
        $tags = Tag::where('type', $type)->orderBy('name');
        if($isSlug){
            return $tags->pluck('name' , 'slug');
        }
        return $tags->pluck('name' , 'id');
        // ->prepend(__('-Choose') , '')
    }

    public function getPriority() 
    {
        return [ '' => '- Choose','high' => 'High', 'medium' => 'Medium' , 'low' => 'Low'  ];
    }
    public function getLeadQuality() 
    {
        return [ '' => '- Choose','good' => 'Good' , 'follow' => 'Follow', 'unqualified' => 'Unqualified'  ];
    }
    public function getType() 
    {
        return [ '' => '- Choose', 'call' => 'Call' , 'meeting' => 'Meeting', 'email' => 'Email'  ];
    }
    public function getStatus() 
    {
        return [ '' => '- Choose', 'done' => 'Done' , 'pending' => 'Pending', 'todo' => 'Todo'  ];
    }
    public function getFinancing() 
    {
        return [ '' => '- Choose', 'cash' => 'Cash' , 'mortgage' => 'Mortgage', 'low' => 'Low'  ];
    }
    public function getShareLinks(){

        $shareLinks = Share::page('https://' . config('panel.live_domain') , 'Share title')
        ->facebook()
        ->whatsapp()
        ->linkedin()
        ->getRawLinks();
        return $shareLinks;
    }

    public function getOwnerId($model){
        $owner = AuditLog::where('description' , 'create')
                        ->where('subject_type' , get_class($model))
                        ->where('subject_id' , $model->id)->pluck('user_id');
        return $owner->first();
    }
    public function createdModels($model){
        $elements = AuditLog::where('description' , 'create')
                        ->where('subject_type' , get_class($model))
                        ->where('user_id' , auth()->user()->id)
                        ->pluck('subject_id');
        return $elements;
    }
    public function hasPermissoin($title){
        $id = auth()->user()->id;
        $roles = $permissions = auth()->user()->roles->all();
        foreach($roles as $role){
            foreach($role->permissions as $permission){
                if($title == $permission->title){
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    public function getPlaces(){
        return [
            'hospital'  => 'Hospital',
            'school'    => 'School',
            'shopping'  => 'Shopping',
            'resturant' => 'Resturant',
            'airport'   => 'Airport',
        ];
    }

    public function getAgents(){
        $agents = User::whereHas('roles' , function(Builder $query){
            $query->where('title' , 'Agent');
        })->pluck('name' , 'id');
        // ->prepend(__('-Choose') , '')
        return $agents;
    }

    public function createTags($tags , $type = 'interests'){
        $tagArray = [];
        if($tags){
            foreach($tags as $_tag){
                $tag = Tag::find($_tag);
                if(!$tag) {
                    if (Gate::allows('tag_create')) {
                        $tag = Tag::create(['name' => $_tag,  'type' => $type ]);
                        array_push($tagArray , $tag->id) ;
                    }
                }
                else {
                    array_push($tagArray , $tag->id) ;
                }
            }
        }
        return $tagArray;
    }

    public function createCities($cities){
        $cityArray = [];
        if($cities){
            foreach($cities as $_city){
                $city = City::find($_city);
                if(!$city) {
                    // Gate::allows('city_create')
                    if(!$_city)
                        continue;
                    
                    if (true) {
                        $city = City::create(['name' => $_city]);
                        array_push($cityArray , $city->id) ;
                    }
                }
                else {
                    array_push($cityArray , $city->id) ;
                }
            }
        }
        return $cityArray;
    }
    
    public function getPropertyStatuses(){
        return [
            '' => __('- Choose'),
            1 => __('Off Plan'),
            2 => __('Ready'),
        ];
    }

    public function createDevelopers($developer){
        $developerArray = [];
        // dd($developer);
        if($developer){
            $_developer = Developer::find($developer);
            if(!$_developer) {
                if (Gate::allows('developer_create')) {
                    $deve = Developer::create(['name' => $developer]);
                    array_push($developerArray , $deve->id) ;
                }
            }
            else {
                array_push($developerArray , $_developer->id) ;
            }
        }
        return $developerArray;
    }

    public function indexAuditlogs($id, $class)
    {
        $this->model = $class::find($id);

        $items = $this->model->auditlogs ?? [];

        return view($this->template.'.auditLogs.history', compact('items'));
    }

    public function getLookingFor(){
        $l = array(
            '' => '-Choose',
            'off-plan' => '0ff-plan',
            'ready' => 'Ready'
        );
        return $l;
    }

    public function getOpeningDates(){
        return [
        '' => '-- Choose',
        'Coming Soon'=> 'Coming Soon',
        'Q1 - 2024' => 'Q1 - 2024',
        'Q2 - 2024' => 'Q2 - 2024',
        'Q3 - 2024' => 'Q3 - 2024',
        'Q4 - 2024' => 'Q4 - 2024',
        'Q1 - 2025' => 'Q1 - 2025',
        'Q2 - 2025' => 'Q2 - 2025',
        'Q3 - 2025' => 'Q3 - 2025',
        'Q4 - 2025' => 'Q4 - 2025',
        'Q1 - 2026' => 'Q1 - 2026',
        'Q2 - 2026' => 'Q2 - 2026',
        'Q3 - 2026' => 'Q3 - 2026',
        'Q4 - 2026' => 'Q4 - 2026',
        'Q1 - 2027' => 'Q1 - 2027',
        'Q2 - 2027' => 'Q2 - 2027',
        'Q3 - 2027' => 'Q3 - 2027',
        'Q4 - 2027' => 'Q4 - 2027',
        'Q1 - 2028' => 'Q1 - 2028',
        'Q2 - 2028' => 'Q2 - 2028',
        'Q3 - 2028' => 'Q3 - 2028',
        'Q4 - 2028' => 'Q4 - 2028',
        'Q1 - 2029' => 'Q1 - 2029',
        'Q2 - 2029' => 'Q2 - 2029',
        'Q3 - 2029' => 'Q3 - 2029',
        'Q4 - 2029' => 'Q4 - 2029',
        'Q1 - 2030' => 'Q1 - 2030',
        'Q2 - 2030' => 'Q2 - 2030',
        'Q3 - 2030' => 'Q3 - 2030',
        'Q4 - 2030' => 'Q4 - 2030',
        ];
    }

    public function getEmirates(){
        return [
            ''               => '-- Choose',
            'Abu Dhabi'      => 'Abu Dhabi',
            'Dubai'          => 'Dubai',
            'Ras Al Khaimah' => 'Ras Al Khaimah',
            'Sharjah'        => 'Sharjah',
            'Ajman'          => 'Ajman',

        ];
    }

    public function getResident(){
        $l = array(
            '' => '-Choose',
            'yes' => 'Yes',
            'no'  => 'No'
        );
        return $l;
    }
    
    public function getClientType(){
        $l = array(
            '' => '-Choose',
            'end-user' => 'End-user',
            'investor' => 'Investor'
        );
        return $l;
    }
}
