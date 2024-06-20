@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('project_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.projects.create') }}" data-value="" data-title="{{ __('Add Project') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Project') }}
                        </a>
                    @endcan
                    <div class="row bg-white p-30">
                        <div class="col-xl">
                            <form class="form-boder" action="{{ route('dashboard.projects.index') }}">
                                <div class="row">
                                    <div class="col-md-10">
                                        <x-inputs.text inputName="search" inputId="search" inputLabel="" error="{{ $errors->has('search') ? $errors->first('search') : '' }}" inputValue="{{ old('search', request()->get('search')) }}" class="mb-3"  inputPlaceholder="{{ __('Search') }}" />
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-filter"></i> {{ __('Apply') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 items-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        {{ __('Id') }}
                                    </th>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Developer') }}
                                    </th>
                                    <th>
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $key => $item)
                                    <tr class="align-items-center">
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td class="w-50">
                                            <h5 class="text-secondary font-400">{{ $item->name }} </h5>
                                            {{ Str::words($item->description, 4) }}
                                        </td>
                                        <td class="w-25">
                                            @foreach($item->developers as $_developer)
                                                <span class="badge bg-info fs-6 m-1">{{$_developer->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('project_show')
                                                <a class="text-primary  me-4 mb-1 viewDetails" href="{{route('dashboard.projects.show' , $item->id)}}" >{{--data-value="{{ route('dashboard.projects.show', $item->id) }}" data-title="{{$item->name}}"--}}
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($item->allowEdit)
                                                @can('project_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.projects.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('project_delete')
                                                    <form action="{{ route('dashboard.projects.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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