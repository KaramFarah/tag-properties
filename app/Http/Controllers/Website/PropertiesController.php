<?php

namespace App\Http\Controllers\Website;

use Share;
use App\Models\User;
use App\Utils\Paginate;
use App\Models\AuditLog;
use App\Rules\ReCaptchaV3;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Unit;
use App\Notifications\GetHelp;
use App\Helpers\DashboardHelper;
use App\Models\Dashboard\Contact;
use App\Models\Dashboard\Project;
use App\Models\Dashboard\Campaign;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\Developer;
use App\Models\Dashboard\Installment;
use Illuminate\Support\Facades\Notification;
use App\Models\Dashboard\City;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\MediaLibrary\Conversions\ImageGenerators\Image;

class PropertiesController extends WebsiteController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = Unit::orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->with('media', 'project' , 'tags' , 'installments' , 'floors' , 'places')->where('published' , 1);
        
        $propertyTypes = (new Unit)->propertyTypes;
        $propertyPurposes = (new Unit)->propertyPurposes;
        $propertyStatuses = (new Unit)->propertyStatuses;
        
        //  SEARCH START
        $price_array = explode(';' , request()->get('sprice'));
        $price_string = implode(';' , $price_array);
        $price_array[0] == 0 ? '' : $price_string = '1000' . $price_string; 
        isset($price_array[1]) ? '' : $price_string = $price_string . ';100000000';
        $price_array[0] == 0 ? $price_array[0] = 1 : '';
        if($price_array[0] && $price_array[1]){
            $query->where('price' , '>=' , $price_array[0])
            ->where('price' , '<=' , $price_array[1]);
        }
        
        if(request()->has('sproperty_purpose') && request()->get('sproperty_purpose')){
            $query->where('property_purpose', request()->get('sproperty_purpose'));
        }
        if(request()->has('sproperty_type') && request()->get('sproperty_type')){
            $query->where('property_type', request()->get('sproperty_type'));
        }
        if(request()->has('sproperty_status') && request()->get('sproperty_status')){
            $query->where('property_status', request()->get('sproperty_status'));
        }
        if(request()->has('sbedrooms') && request()->get('sbedrooms')){
            $query->whereRaw('CAST(bedrooms AS UNSIGNED) <= ?', [request()->get('sbedrooms')]);
        }
        if(request()->has('sbathrooms') && request()->get('sbathrooms')){
            $query->whereRaw('CAST(bathrooms AS UNSIGNED) <= ?', [request()->get('sbathrooms')]);
        }
        
        if(request()->has('smax_area') && request()->get('smax_area')){
            $query->where('area_sqft' , '<=' , request()->get('smax_area'));
        }
        if(request()->has('smin_area') && request()->get('smin_area')){
            $query->where(['area_sqft' , '>=' , request()->get('smin_area')]);
        }
        // $query->where('garage', request()->query('sgarage'));

        if(request()->has('sstatus') && request()->get('sstatus')){
            $query->where('property_status', request()->get('sstatus'));
        }
        // isset($countries[$project->country]) ? $country = $countries[$project->country] : $country = '';
        // if($slocation){
            
        //     $query->whereHas('project', function($query) use($slocation){
        //         $query->where('community' , 'like' , "%$slocation%")
        //         ->orWhere('city' , 'like' , "%$slocation%");
        //         // ->orWhere('country' ,'like', "%$slocation%");
        //     });
        // }
        // dd($scountry);


        // if($slocation){
        //     $query->whereHas('project', function($query){
        //         $slocation = request()->slocation;
        //         $query->where('location' , 'like' , "%$slocation%")
        //         ->orWhere('city' , 'like' , '%$slocation%');
        //     });
        // }

        if(request()->has('scountry') && request()->get('scountry')){
            $query->whereHas('project', function($query) {
                $query->where('country' , request()->get('scountry'));
            });
        }
        if(request()->has('sFeatures') && request()->get('sFeatures')){
            $query->whereHas( 'tags', function($query){
                $query->whereIn('unit_tag.tag_id',request()->get('sFeatures'))
                ->havingRaw('count(DISTINCT unit_tag.tag_id) = '. count(request()->get('sFeatures')));
            });
        }
        if(request()->has('skeyword') && request()->get('skeyword')){
            $query->where(function($query) {
                $query->where('name' , 'like' , '%'.request()->has('skeyword').'%')
                ->orWhere('description' , 'like' , '%'.request()->has('skeyword').'%');
            });
        }

        $units = $query->paginate(20)->withQueryString();

        // Get Favourite Units
        if(auth()->user()){
            $user = auth()->user();
            $favorites = $user->favorites()->pluck('id')->toArray();
        }else{
            $favorites = [];
        }
        $countries = DashboardHelper::countries();
        $features = Tag::where('type', 'features')->get();

        $recentProperties = $this->getRecentProperties();
        $featueredProperties = $this->getFeaturedProperties();

        $local_title = __('All Properties');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.properties', compact( 'countries', 'favorites', 'features', 'price_string', 'recentProperties', 'featueredProperties', 'units', 'local_title', 'local_description', 'breadcrumbs', 'propertyTypes', 'propertyPurposes', 'propertyStatuses'));
    }

    public function show(Unit $unit)
    {
        abort_if(!$unit->published && auth()->user()->id != ($unit->createdBy->id ?? 0), 404, 'Not found!');
        
        $recentProperties = $this->getRecentProperties();
        $local_title = __($unit->name);
        $shareLink = Share::page(route('propertyShow' , ['unit' => $unit->slug]) , $unit->name . ' | ' . config('panel.website_title'))
        ->facebook()
        ->whatsapp()
        ->telegram()
        ->twitter()
        ->getRawLinks();
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('All Properties'), 'url' => route('properties')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.property-single', compact( 'recentProperties', 'shareLink', 'unit', 'local_title', 'breadcrumbs'));
    }
    
    public function getShareLinks(){

        $shareLinks = Share::page(url()->current() , 'Share title')
        ->facebook()
        ->whatsapp()
        ->linkedin()
        ->twitter()
        ->getRawLinks();
        return $shareLinks;
        // return Share::page(url()->current())->whatsapp();
    }

    public function print(Unit $unit){

        return view('website.property-printing', compact('unit'));
    }

    public function sendEmails()
    {
        // dd(true);
        
        // $validator = request()->validate([
        //     'g-recaptcha-response' => ['required', new ReCaptchaV3('submitMail')],
        // ]);

        $user = null;
        if (config('panel.create_lead_getHelp')){

            DashboardHelper::createLead(request()->get('mailer'), 'Website - Get Help');
        }
        
        AuditLog::create([
            'description'  => 'create',
            'subject_id'   => 0,
            'subject_type' => GetHelp::class,
            'user_id'      => Auth()->user->id ?? 0,
            'properties'   => request()->get('mailer'),
            'host'         => request()->ip() ?? null,
        ]);

        $user = User::firstOrCreate(['email' => config('panel.contact_receiver')]);

        Notification::send($user, new GetHelp(request()->get('mailer')));
       
        return back()->with('success', __('Your request was sent successfully. We will contact you soon.'));
    }


    public function list(){
        $projects = Project::orderBy('name')->pluck('name', 'id')->prepend('- Choose', '')->all();
        $installments = Installment::pluck('milestone', 'id')->prepend('- Choose', '')->all();
        $features = Tag::where('type', 'features')->get();
        $developers = Developer::all()->pluck('name' , 'id');
        $emirates = $this->getEmirates();
        $types = [
            '' => __('- Choose'),
            1 => __('Off-Plan'),
            2 => __('Ready'),
        ];

        $agents = User::whereHas('roles' , function($q){
            $q->where('title', 'Agent');
        })->pluck('name' , 'id')->toArray();

        $emirates = $this->getEmirates();
        $countries = DashboardHelper::countries();
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $local_title = __('List Your Property');
        $local_description = '';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.list_property' , compact('local_title', 'local_description', 'breadcrumbs', 'countries', 'types', 'developers', 'features', 'projects', 'installments', 'emirates', 'cities'));
    }

    public function collectLead(Request $request)
    {
        DashboardHelper::createLead(['name' => $request->get('lead_name'), 'email' => $request->get('lead_email'), 'occupation' => $request->get('lead_desgination'), 'phone' => $request->get('lead_phone')], $request->get('campaign'));

        return redirect($request->get('download-link'));
    }

}
