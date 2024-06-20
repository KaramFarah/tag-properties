@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
                <div class="overflow-x-scroll font-fifteen">
                    <div class="m-30">
                        @can('agent_create')
                            <a class="btn btn-success rounded-pill" href="{{ route('dashboard.agents.create') }}" data-value="" data-title="{{ __('Add Agent') }}">
                                <i class="fa fa-plus"></i> {{ __('Add Agent') }}
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
                                        <th class="w-50">
                                            {{ __('Name') }}
                                        </th>
                                        <th>
                                            {{ __('Email') }}
                                        </th>
                                        <th class="w-25">
                                            {{ __('Options') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agents as $agent)
                                        <tr id="{{ $agent->id }}">
                                            <td>
                                                {{ $agent->id }}
                                            </td>
                                            <td>
                                                <h5 class="text-secondary font-400">{{ $agent->name }}</h5>
                                                {{ $agent->phone }}
                                            </td>
                                            <td>
                                                {{$agent->email}}
                                            </td>
                                            <td>
                                                @can('agent_show')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.agents.show', $agent->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('agent_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.agents.edit', $agent->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('agent_delete')
                                                    <form action="{{ route('dashboard.agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection