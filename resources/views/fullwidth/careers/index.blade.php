@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('career_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.careers.create') }}" data-value="" data-title="{{ __('Add Developer') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Career') }}
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
                                        {{ __('Job Title') }}
                                    </th>
                                    <th >
                                        {{ __('CVs') }}
                                    </th>
                                    <th class="w-25">
                                        {{ __('Type') }}
                                    </th>
                                    <th class="w-25">
                                        {{__('Options')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($careers as $key => $career)
                                    <tr class="align-careers-center">
                                        <td>
                                            {{ $career->id }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary font-400">
                                                {{ $career->job_title }}
                                            </h5>
                                            {{ $career->expiry_date }}
                                        </td>
                                        <td>
                                            {{ $career->careerCvs->count() }}
                                        </td>
                                        <td>
                                            {{ $career->employment_type }}
                                        </td>
                                        <td>
                                            @can('career_show')
                                                <a class="text-primary  me-4 mb-1 viewDetails" href="{{ route('dashboard.careers.show', $career->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($career->allowEdit)
                                                @can('career_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.careers.edit', $career->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('career_delete')
                                                    <form action="{{ route('dashboard.careers.destroy', $career->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this career?') }}');" style="display: inline-block;">
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
                            {{$careers->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $careers]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection