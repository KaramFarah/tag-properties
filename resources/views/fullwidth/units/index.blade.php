@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
                <div class="overflow-x-scroll font-fifteen">
                    <div class="m-30">
                        @can('unit_create')
                            <a class="btn btn-success rounded-pill" href="{{ route('dashboard.units.create') }}">
                            <i class="fa fa-plus"></i> {{ __('Submit Property') }}
                        </a>
                        @endcan
                        <div class="bg-white p-30">
                            <div class="row">
                                <div class="col-xl">
                                    <form class="form-boder" action="{{ route('dashboard.units.index') }}">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <x-inputs.text inputName="search" inputId="search" inputLabel="" error="{{ $errors->has('search') ? $errors->first('search') : '' }}" inputValue="{{ old('search', request()->get('search')) }}" class="mb-3"  inputPlaceholder="{{ __('Search') }}" />
                                                {{-- <x-inputs.text inputName="q" inputId="q" inputLabel="" error="{{ $errors->has('q') ? $errors->first('q') : '' }}" inputValue="{{ old('q', request()->q ?? '') }}" class="mb-3"  inputPlaceholder="{{ __('Search') }}" /> --}}
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
                                            {{ __('Published') }}
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
                                                <h5 class="text-secondary font-400">{{ $item->name }}</h5>
                                            </td>
                                            <td>
                                                {{ $item->published ? __('Yes') : __('No') }}
                                            </td>
                                            <td>
                                                @can('unit_show')
                                                    <a class="text-primary  me-4 mb-1 viewDetails" href="{{ route('dashboard.units.show', $item->id) }}" >
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('unit_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.units.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('unit_delete')
                                                    <form action="{{ route('dashboard.units.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">{{ __('No records') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center" >
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