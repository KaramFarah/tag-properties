<?php

namespace App\Http\Controllers\Website;

use App\Helpers\DashboardHelper;
use Illuminate\Http\Request;
use App\Models\Dashboard\Career;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\CareerCvRequest;
use App\Mail\CareerAppliation;
use App\Models\Dashboard\CareerCv;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CareersWebsiteController extends BaseController
{
    public function index(){
        $careers = Career::latest()->get();
        $local_title = __('Careers');
        $local_description = 'We make strategies, design & development to create valuable products.';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.careers.careers', compact( 'careers', 'local_title', 'local_description', 'breadcrumbs') );
    }

    public function apply(Career $career){
        $local_title = $career->job_title . ' | ' . __('Careers');
        $local_description = Str::words($career->job_description, 8, '...');
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('Careers'), 'url' => route('careers-list')];
        $breadcrumbs[] = ['label' => $local_title];

        $countries = $this->countries;
        $cities = $this->getEmirates();

        return view('website.careers.apply-career' , compact( 'cities', 'countries', 'career', 'local_title', 'local_description', 'breadcrumbs') );
    }

    public function store(CareerCvRequest $request)
    {
        $data = $request->all();
        if (!auth()->user()){
            $user = User::where('email', $request->get('email'))->first();
            if (!$user){
                $user = User::create(['name' => $request->get('name'), 'email' => $request->get('email')]);
                if ($user->id){
                    $data['user_id'] = $user->id;
                }
            }
            else{
                $data['user_id'] = $user->id;
            }
        }
        
        DashboardHelper::createLead($data, 'Website - Career');
        
        $careerCv = CareerCv::create($data);
        if ($request->hasFile('cv')){
            if (!$careerCv->addMedia($request->cv)->toMediaCollection('cv', 'media')) {
                $request->session()->flash('danger', __('Unable to save this file'));
            }       
        }
        if ($careerCv->id) {
            Mail::to($request->get('email'))->send(new CareerAppliation($careerCv));

            return redirect()->route('careers-list')->with(['message' => 'Submitted']);
        }
        else {
            return redirect()->route('careers-list')->with(['danger' => __('Error!')]);
        }
    }
}
