@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
                <div class="overflow-x-scroll font-fifteen">
                    <div class="m-30">
                        @can('tag_create')
                            <a class="btn btn-success rounded-pill" href="{{ route('dashboard.tags.create', ['type' => request()->get('type')]) }}">
                                <i class="fa fa-plus"></i> {{ __('trans.Add Tag', [] , 'en') }}
                            </a>
                        @endcan
                        <form action="{{route('dashboard.tags.index')}}" method="GET">
                            <div class="row my-30 align-items-end">
                                <div class="col-md-4">
                                    <x-inputs.select inputName="type" inputId="type" :inputData="$types" inputValue="{{old('type', request()->get('type'))}}" showButtons="false" inputLabel="{{__('Type')}}"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="search" class="form-label">{{ __('Search') }}</label>
                                    <input type="text" class="form-control border" name="search" id="search" value="{{old('search', request()->get('search'))}}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-filter"></i> {{ __('Apply') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table w-100 items-list bg-transparent table-hover">
                                <thead>
                                    <tr class="bg-white">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            {{ __('Id') }}
                                        </th>
                                        <th>
                                            {{ __('Name') }}
                                        </th>
                                        <th>
                                            {{ __('Value Type') }}
                                        </th>
                                        <th class="w-25">
                                            {{ __('Options') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $tag)
                                        <tr id="{{ $tag->id }}">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $tag->id }}
                                            </td>
                                            <td>
                                                <h5 class="text-secondary font-400">{{ $tag->name }}</h5>{{ $tag->parent ? ($tag->parent->name ?? '') : ''}}{{$tag->type ? ($tag->parent ? ', ' : '') . $tag->type : ''}}
                                            </td>
                                            <td>
                                                {{ $tag->valueTypeText }}
                                            </td>
                                            <td>
                                                @can('tag_show')
                                                    <a class="text-primary me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.tags.show', $tag->id) }}" data-title="{{ $tag->name }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @if($tag->allowEdit)
                                                    @can('tag_edit')
                                                        <a class="text-primary me-4 mb-1" href="{{ route('dashboard.tags.edit', $tag->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('tag_delete')
                                                        <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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