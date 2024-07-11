@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('project_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.installments.create') }}" data-value="" data-title="{{ __('Add Financial Notes') }}">
                            <i class="fa fa-plus"></i> {{ __('Add Financial Notes') }}
                        </a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table w-100 items-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        {{ __('Id') }}
                                    </th>
                                    <th>
                                        {{ __('Type') }}
                                    </th>
                                    <th>
                                        {{ __('Payment') }}
                                    </th>
                                    <th>
                                        {{ __('Options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($installments as $key => $installment)
                                    <tr class="align-items-center">
                                        <td>
                                            {{ $installment->id }}
                                        </td>
                                        <td class="w-25">
                                            <h5 class="text-secondary font-400">{{ $installment->type }}</h5>
                                            {{ $installment->milestone }}
                                        </td>
                                        <td class="w-25">
                                            {{ $installment->payment }}
                                        </td>
                                        <td>
                                            @can('installment_show')
                                                <a class="text-primary  me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.installments.show', $installment->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($installment->allowEdit)
                                                @can('installment_edit')
                                                    <a class="text-primary me-4 mb-1" href="{{ route('dashboard.installments.edit', $installment->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('installment_delete')
                                                    <form action="{{ route('dashboard.installments.destroy', $installment->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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
                            {{$installments->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $installments]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection