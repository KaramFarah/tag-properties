@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('floor_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.floors.create') }}" data-value="" data-title="{{ __('Add Developer') }}"><i class="fa fa-plus"></i> {{ __('Add floor') }}</a>
                    @endcan

                    <div class="table-responsive">
                        <table class="table w-100 items-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        {{ __('Id') }}
                                    </th>
                                    <th class="w-25"> 
                                        {{ __('Title') }}
                                    </th>
                                
                                    <th class="w-25">
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($floors as $key => $item)
                                    <tr class="align-items-center">
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary font-400">
                                                {{ $item->title }}
                                            </h5>
                                        </td>
                                       
                                        <td>
                                            
                                            
                                            @can('floor_show')
                                                <a class="text-primary p-10" href="{{ route('dashboard.floors.show', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($item->allowEdit)
                                                @can('floor_edit')
                                                    <a class="text-primary p-10" href="{{ route('dashboard.floors.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('floor_delete')
                                                    <form action="{{ route('dashboard.floors.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection