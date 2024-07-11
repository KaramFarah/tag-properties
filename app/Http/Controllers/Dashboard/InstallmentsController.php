<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\InstallmentRequest;
use App\Models\Dashboard\Installment;
use Gate;
use Psy\VersionUpdater\Installer;
use Symfony\Component\HttpFoundation\Response;

class InstallmentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('installment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $local_title = __('Financial Notes');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        $installments = $this->search();

        return view($this->template.'.installments.index', compact('local_title', 'breadcrumbs', 'installments'));
    }

    public function search(){
        $query = Installment::orderBy('type');

        // if(request()->has('name') && request()->get('name')){
        //     $query->where('name', 'like', '%'.request()->get('name').'%');  
        // }

        // if(request()->has('description') && request()->get('description')){
        //     $query->where('description', 'like', '%'.request()->get('description').'%');  
        // }
        
        return $query->paginate(100);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('installment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = __('Add Financial Notes');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Installments'), 'url' => route('dashboard.installments.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.installments.create', compact('local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstallmentRequest $request)
    {
        $model = Installment::create($request->all());
        
        if ($model){
            return redirect()->route('dashboard.installments.index', $model)->with(['success' => 'Added']);
        }
        else{
            return redirect()->route('dashboard.installments.create')->with(['danger' => 'Error!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Installment $installment)
    {
        abort_if(Gate::denies('installment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s \%s \%s', $installment->type, $installment->milestone, $installment->payment);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Financial Note'), 'url' => route('dashboard.installments.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.installments.show', compact('installment', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installment $installment)
    {
        abort_if(Gate::denies('installment_edit') || !$installment->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s: %s', __('Edit Financial Notes'), $installment->milestone);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Installments'), 'url' => route('dashboard.installments.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.installments.show', ['installment' => $installment])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.installments.edit', compact('installment','local_title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstallmentRequest $request, Installment $installment)
    {
        if ($installment->update($request->all())){
            return redirect()->route('dashboard.installments.index')->with(['success' => __('Updated')]);
        }
        else{
            return redirect()->route('dashboard.installments.edit', $installment->id)->with(['danger' => __('Error!')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installment $installment)
    {
        abort_if(Gate::denies('installment_delete') || !$installment->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $installment->delete();

        return back()->with(['danger' => 'Deleted']);
    }
}
