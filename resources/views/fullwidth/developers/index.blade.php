@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('project_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.developers.create') }}" data-value="" data-title="{{ __('Add Developer') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Developer') }}
                        </a>
                    @endcan
                    <div class="row g-white p-30">
                        <div class="col-xl">
                            <form class="form-boder" action="{{ route('dashboard.developers.index') }}">
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
                                    <th class="w-75">
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($developers as $key => $developer)
                                    <tr class="align-items-center">
                                        <td>
                                            {{ $developer->id }}
                                        </td>
                                        <td>
                                            @if ($developer->logoThumb)
                                                <img class="rounded" src="{{ $developer->logoThumb ?? '' }}" alt="{{$developer->name }} logo thumbnail">
                                            @endif
                                            <h5 class="text-secondary font-400">{{ $developer->name }}</h5>
                                            {{ Str::words($developer->description, 15) }}
                                        </td>
                                        <td>
                                            @can('developer_show')
                                                <a class="text-primary  me-4 mb-1" href="{{ route('dashboard.developers.show', $developer->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($developer->allowEdit)
                                                @can('developer_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.developers.edit', $developer->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('developer_delete')
                                                    <form action="{{ route('dashboard.developers.destroy', $developer->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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
                            {{$developers->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $developers]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection