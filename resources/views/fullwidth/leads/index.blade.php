@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('lead_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.leads.create') }}" data-value="" data-title="{{ __('Add Developer') }}"><i class="fa fa-plus"></i> {{ __('Add Lead') }}</a>
                    @endcan
                    

                    <div class="col m-4">
                        <form action="" method="GET">
                            <div class="input-group">

                                <select class="form-select col-2 me-3" name="qulityFilter" id="priorityFilter">
                                    <option value="">-- Quality</option>
                                    <option @selected($qulityFilter == 'good') value="good">Good</option>
                                    <option @selected($qulityFilter == 'follow') value="follow">Follow</option>
                                    <option @selected($qulityFilter == 'unqualified') value="unqualified">Unqualified</option>
                                </select>
                                <select class="form-select col-2 me-3" name="priorityFilter" id="priorityFilter">
                                    <option value="">-- Priority</option>
                                    <option @selected($priorityFilter == 'high') value="high">High</option>
                                    <option @selected($priorityFilter == 'medium') value="medium">Meduim</option>
                                    <option @selected($priorityFilter == 'low') value="low">Low</option>
                                </select>

                                <input type="text" class="w-50 form-control me-3 border" name="search" placeholder="{{ __('Search') }}" value="{{isset($search) ? $search : old('search') ?? ''}}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> {{ __('Apply') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    {{-- <x-search-bar searchInput="{{$search}}"></x-search-bar> --}}

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
                                    <th class="w-25">
                                        {{ __('Quality & Priorty') }}
                                    </th>
                                    @if(!Auth::user()->isAgent)
                                        <th>
                                            {{ __('Agents') }}
                                        </th>
                                        <th>
                                            {{ __('Campaigns') }}
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
                                            {{ $item->id }}
                                        </td>
                                        <td>
                                            <h5 class="text-secondary font-400">
                                                {{ $item->name }}
                                            </h5>
                                            {{ $item->mobile }}, {{ $item->email }}
                                        </td>
                                        <td>
                                            <x-lead-quality :variable="$item"></x-lead-quality>, {{ucfirst($item->priority)}}, {{ $item->interested ? __('Interested') : __('Not Interested') }}
                                        </td>
                                        @if(!Auth::user()->isAgent)
                                            <td>
                                                @foreach($item->agents as $_agent)
                                                    <span class="badge bg-info fs-6 m-1">{{ $_agent->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{$item->Campaign->name ?? ''}}
                                            </td>
                                        @endif
                                        <td>
                                            @can('contact_create')
                                                <a class="text-success p-10" href="{{ route('dashboard.leads.convert', $item->id) }}" title="{{ __('Convert to Client') }}">
                                                    <i class="fa-solid fa-people-arrows"></i>
                                                </a>
                                                {{-- <a class="text-primary  me-4 mb-1 viewDetails" href="{{ route('dashboard.contacts.edit', $item->id) }}" title="{{ __('Convert to Client') }}">
                                                    <i class="fa-solid fa-people-arrows"></i>
                                                </a> --}}
                                            @endcan
                                            @can('call_create')
                                                <a class="text-success p-10" href="{{route('dashboard.actions.add' , $item->id)}}" title="{{ __('Add Action Registery') }}">
                                                    <i class="fa-regular fa-calendar-plus"></i>
                                                </a>
                                            @endcan
                                            @can('lead_show')
                                                <a class="text-primary p-10" href="{{ route('dashboard.leads.show', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @if($item->allowEdit)
                                                @can('lead_edit')
                                                    <a class="text-primary p-10" href="{{ route('dashboard.leads.edit', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('lead_delete')
                                                    <form action="{{ route('dashboard.leads.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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
                                        <td colspan="5">{{ __('No records') }}</td>
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