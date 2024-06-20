@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
                <div class="overflow-x-scroll font-fifteen">
                    <div class="m-30">
                        <div class="row g-white p-30">
                            <div class="col-xl">
                                <form class="form-boder" action="{{ route('dashboard.audit-logs.index') }}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <x-inputs.text inputName="description" inputId="description" inputLabel="" error="{{ $errors->has('description') ? $errors->first('description') : '' }}" inputValue="{{ old('description', request()->get('description')) }}" class="mb-3"  inputPlaceholder="{{ __('Description') }}" />
                                        </div>
                                        <div class="col-md-8">
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
                                            {{ __('Activity') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $auditLog)
                                    {{-- {{dd($auditLog->creator)}} --}}
                                        <tr id="{{ $auditLog->id }}">
                                            <td>
                                                {!! $auditLog->activity !!}
                                            </td>
                                            <td>
                                                @can('audit_log_show')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.audit-logs.show', $auditLog->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
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