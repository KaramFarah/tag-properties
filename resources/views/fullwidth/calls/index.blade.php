@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('call_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.actions.create') }}" data-value="" data-title="{{ __('Add Developer') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Action') }}
                        </a>
                    @endcan
                    <x-search-bar searchInput="{{$search}}"></x-search-bar>
                    <div class="table-responsive">
                        <table class="table w-100 calls-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th class="text-decoration-none">
                                        {{ __('Id') }}
                                    </th>
                                    <th class="w-50">
                                        {{__('Title') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th class="w-25">
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($calls as $key => $action)
                                    <tr class="align-calls-center">
                                        <td>
                                            {{ $action->id }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary fs-400">
                                                {{ Str::ucfirst($action->contact->name ?? '') }}
                                            </h5>
                                            <b><u>{{ Str::ucfirst($action->type) }}</u></b> {{ __('On') }} {{ date('Y-m-d H:i', strtotime($action->date)) }} By {{ Str::ucfirst($action->agent->name ?? '') }}
                                        </td>
                                        <td>
                                            {{ Str::ucfirst($action->status) }}
                                        </td>
                                        <td>
                                            @can('call_show')
                                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.actions.show', $action->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($action->allowEdit)
                                                @can('call_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.actions.edit', $action->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('call_delete')
                                                    <form action="{{ route('dashboard.actions.destroy', $action->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this call?') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('No records') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{$calls->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $calls]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection