<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Campaign;
use App\Http\Requests\CampaignStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class CampaignsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('campaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query= Campaign::orderBy('name')->orderBy('start_date');
        if ($search = request()->search)
        $query->where('name' , 'like' , "%$search%")
        ->orWhere('description' , 'like' , "%$search%")
        ->orWhere('start_date' , 'like' , "%$search%")
        ->orWhere('end_date' , 'like' , "%$search%")
        ->orWhere('network' , 'like' , "%$search%");
        $campaigns = $query->paginate(100)->appends([
            'search' => $search,
        ]);

        $local_title = __('Campaigns');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.campaigns.index', compact('search','campaigns', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //abort_if(Gate::denies('campaign_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = __('Add Campaign');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Campaigns'), 'url' => route('dashboard.campaigns.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.campaigns.create', compact('local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampaignStoreRequest $request)
    {
        // dd($request->all());
        $model = Campaign::create($request->all());
        if ($model->id) return redirect()->route('dashboard.campaigns.index')->with(['message' => 'Created']); else return redirect()->route('dashboard.campaigns.index')->with(['danger' => __('Error!')]);
    }

    public function show(Campaign $campaign)
    {
        abort_if(Gate::denies('campaign_show') || !$campaign->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $campaign->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Campaigns'), 'url' => route('dashboard.campaigns.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.campaigns.show', compact('campaign', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        abort_if(Gate::denies('campaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s: %s', __('Edit Campaign'), $campaign->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Campaigns'), 'url' => route('dashboard.campaigns.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.campaigns.show', ['campaign' => $campaign])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.campaigns.edit', compact('campaign','local_title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CampaignStoreRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());

        return redirect()->route('dashboard.campaigns.index')->with(['info' => __('Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        abort_if(Gate::denies('campaign_delete') || !$campaign->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaign->delete();

        return back()->with(['danger' => __('Deleted')]);
    }
}
