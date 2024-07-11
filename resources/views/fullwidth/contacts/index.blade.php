
@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('contact_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.contacts.create') }}" data-value="" data-title="{{ __('Add Developer') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Client') }}
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
                                    <th class="w-25">
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    @if(!Auth::user()->isAgent)
                                        <th>
                                            {{ __('Agents') }}
                                        </th>
                                    @endif
                                    <th class="w-25">
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $key => $item)
                                    <tr class="align-items-center">
                                        <td>
                                            {{ $item->id ?? '' }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary font-400">
                                            {{$item->title ?? ''}} {{ $item->name ?? ''}}
                                            </h5>
                                            {{ $item->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $item->email ?? '' }}
                                        </td>
                                        @if(!Auth::user()->isAgent)
                                            <td>
                                                @foreach($item->agents as $_agent)
                                                    <span class="badge bg-info fs-6 m-1">{{ $_agent->name }}</span>
                                                @endforeach
                                            </td>
                                        @endif
                                        <td>
                                            @can('call_create')
                                                <a class="text-success  me-4 mb-1 viewDetails" href="{{route('dashboard.actions.add' , $item->id)}}" title="{{ __('Add Action Registery') }}">
                                                    <i class="fa-regular fa-calendar-plus"></i>
                                                </a>
                                            @endcan
                                            @can('contact_show')
                                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.contacts.show', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($item->allowEdit)
                                                @can('contact_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.contacts.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('contact_delete')
                                                    <form action="{{ route('dashboard.contacts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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
                            {{$items->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $items])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection