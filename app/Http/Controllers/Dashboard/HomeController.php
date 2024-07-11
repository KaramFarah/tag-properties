<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\DashboardHelper;
use App\Models\AuditLog;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\Blog;
use App\Models\Dashboard\Contact;
use App\Models\Dashboard\Developer;
use App\Models\Dashboard\Unit;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController
{
    public function index()
    {
        $local_title = __('Dashboard');
        $breadcrumbs[] = ['label' => __('Dashboard')];
        $params = [];
        $params['activities'] = AuditLog::latest()->limit(10)->get();
        if (Gate::allows('lead_access')){
            if (Auth()->user()->isAgent){
                $params['total_leads'] =  Contact::where('is_lead', 'yes')->whereRelation('agents', 'id', auth()->user()->id)->get()->count();
            }
            else{
                $params['total_leads'] =  Contact::where('is_lead', 'yes')->get()->count();
            }
        }
        else{
            $params['total_leads'] =  0;
        }

        if (Gate::allows('contact_access')){
            if (Auth()->user()->isAgent){
                $params['total_clients'] =  Contact::where('is_lead', 'no')->whereRelation('agents', 'id', auth()->user()->id)->get()->count();
            }
            else{
                $params['total_clients'] =  Contact::where('is_lead', 'no')->get()->count();
            }
        }
        else{
            $params['total_clients'] =  0;
        }
        
        $params['total_agents'] = Gate::allows('agent_access') ? User::whereRelation('roles', 'title', 'Agent')->get()->count() : 0;
        $params['total_units'] = Gate::allows('unit_access') ? Unit::where('availability', 1)->get()->count() : 0;
        $params['total_developers'] = Gate::allows('developer_access') ? Developer::all()->count() : 0;
        $params['total_blogs'] = Gate::allows('blog_access') ? Blog::all()->count() : 0;

        return view($this->template . '.home', compact('local_title', 'breadcrumbs', 'params'));
    }

    public function clearCache(){
        abort_if(Gate::denies('clear_cache_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Artisan::call('optimize:clear');

        return back()->with(['success' => "Cleared!"]);
    }
}
