@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('campaign_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.campaigns.create') }}" data-value="" data-title="{{ __('Add Developer') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Campaign') }}
                        </a>
                    @endcan
                    <x-search-bar searchInput="{{$search}}"></x-search-bar>
                    <div class="table-responsive">
                        <table class="table w-100 items-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        {{ __('Id') }}
                                    </th>
                                    <th class="w-75">
                                        {{ __('Name') }}
                                    </th>
                                    <th class="w-25">
                                        {{__('Options')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($campaigns as $key => $campaign)
                                    <tr class="align-campaigns-center">
                                        <td>
                                            {{ $campaign->id }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary font-400">
                                                {{ $campaign->name }}
                                            </h5>
                                            {{ $campaign->start_date }} / {{ $campaign->end_date }}
                                        </td>
                                        <td>
                                            @can('campaign_show')
                                                <a class="text-primary  me-4 mb-1 viewDetails" href="#" data-title="{{ $campaign->name }}" data-value="{{ route('dashboard.campaigns.show', $campaign->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($campaign->allowEdit)
                                                @can('campaign_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.campaigns.edit', $campaign->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('campaign_delete')
                                                    <form action="{{ route('dashboard.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this campaign?') }}');" style="display: inline-block;">
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
                                        <td colspan="4">{{ __('No records') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{$campaigns->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $campaigns]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection