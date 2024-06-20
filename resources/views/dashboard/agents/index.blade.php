@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('agent_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.agents.create') }}" data-value="" data-title="{{ __('Add Agent') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Agent') }}
                    </a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="w-100 items-list bg-transparent">
                    <thead>
                        <tr class="bg-white">
                            <th>
                                {{ __('Id') }}
                            </th>
                            <th>
                                {{ __('Name') }}
                            </th>
                            <th>
                                {{ __('Email') }}
                            </th>
                            <th>
                                {{ __('Phone') }}
                            </th>
                            <th>
                                {{ __('Roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agents as $agent)
                            <tr wire:key="{{ $agent->id }}">
                                <td>
                                    {{ $agent->id }}
                                </td>
                                <td>
                                    <h5 class="text-secondary font-400">{{ $agent->name }}</h5>
                                </td>
                                <td>
                                    {{ $agent->email }}
                                </td>
                                <td>
                                    {{ $agent->phone ?? '' }}
                                </td>
                                <td>
                                    @foreach($agent->roles as $key => $item)
                                        <span class="badge bg-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('agent_show')
                                        <a class="text-primary me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.agents.show', $agent->id) }}">
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
            {{-- <livewire:Dashboard.SearchAgents /> --}}
        </div>
    </div>
@endsection