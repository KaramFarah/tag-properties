@extends(config('panel.template') . '.layouts.app')
@section('content')
    <div class="row row-cols-xxl-4 row-cols-lg-2 row-cols-1 g-4 mb-30">
        @can('unit_access')
            <div class="col">
                <div class="ball p-4 position-relative text-white rounded" style="background-color: #55e3b0;">
                    <i class="flaticon-home flat-medium float-start pe-3" aria-hidden="true"></i>
                    <h4 class="m-0 text-white">{{ $params['total_units'] }}</h4>
                    <span class="d-table">{{__('Available Property') }}</span>
                </div>
            </div>
        @endcan
        @can('developer_access')
        <div class="col">
            <div class="ball p-4 position-relative text-white rounded" style="background-color: #6586f1;">
                <i class="flaticon-hook flat-medium float-start pe-3" aria-hidden="true"></i>
                <h4 class="m-0 text-white">{{ $params['total_developers'] }}</h4>
                <span class="d-table">{{ __('Developers') }}</span>
            </div>
        </div>
        @endcan
        @can('lead_access')
            @if(Auth::user()->isAgent)
                <div class="col">
                    <div class="ball p-4 position-relative text-white rounded" style="background-color: #dc69f1;">
                        <i class="flaticon-network flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0 text-white">{{ $params['total_leads'] }}</h4>
                        <span class="d-table">{{ __('My Leads') }}</span>
                    </div>
                </div>
            @else
                <div class="col">
                    <div class="ball p-4 position-relative text-white rounded" style="background-color: #dc69f1;">
                        <i class="flaticon-network flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0 text-white">{{ $params['total_leads'] }}</h4>
                        <span class="d-table">{{ __('Total Leads') }}</span>
                    </div>
                </div>
            @endif
        @endcan
        @can('contact_access')
            @if(Auth::user()->isAgent)
                <div class="col">
                    <div class="ball p-4 position-relative text-white rounded" style="background-color: #f1c643;">
                        <i class="flaticon-group-1 flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0 text-white">{{ $params['total_clients'] }}</h4>
                        <span class="d-table">{{ __('My Clients') }}</span>
                    </div>
                </div>
            @else
                <div class="col">
                    <div class="ball p-4 position-relative text-white rounded" style="background-color: #f1c643;">
                        <i class="flaticon-group-1 flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0 text-white">{{ $params['total_clients'] }}</h4>
                        <span class="d-table">{{ __('Clients') }}</span>
                    </div>
                </div>
            @endif 
        @endcan
        @can('agent_access')
        <div class="col">
            <div class="ball p-4 position-relative text-white rounded" style="background-color: #ee6565;">
                <i class="flaticon-support flat-medium float-start pe-3" aria-hidden="true"></i>
                <h4 class="m-0 text-white">{{ $params['total_agents'] }}</h4>
                <span class="d-table">{{ __('Agents') }}</span>
            </div>
        </div>
        @endcan
        @can('blog_access')
            <div class="col">
                <div class="ball p-4 position-relative text-white rounded" style="background-color: #d47910;">
                    <i class="flaticon-survey flat-medium float-start pe-3" aria-hidden="true"></i>
                    <h4 class="m-0 text-white">{{ $params['total_blogs'] }}</h4>
                    <span class="d-table">{{ __('Blogs') }}</span>
                </div>
            </div>
        @endcan
    </div>
    <div class="row">
        {{-- <div class="col-md-12 col-xl-6">
            <div class="p-30 bg-white border rounded mb-30 clearfix">
                <h5 class="mb-4">Profile Overview</h5>
                <div class="row row-cols-lg-2 row-cols-1 g-4">
                    <div class="col">
                        <i class="flaticon-home flat-medium text-primary float-start me-3"></i>
                        <span class="m-0 h5 d-block">580</span>
                        <span class="d-table">Property Deals</span>
                    </div>
                    <div class="col">
                        <i class="flaticon-chat flat-medium text-primary float-start me-3"></i>
                        <span class="m-0 h5 d-block">580</span>
                        <span class="d-table">Total Public Comments</span>
                    </div>
                    <div class="col">
                        <i class="flaticon-audit flat-medium text-primary float-start me-3"></i>
                        <span class="m-0 h5 d-block">580</span>
                        <span class="d-table">Property Views</span>
                    </div>
                    <div class="col">
                        <i class="flaticon-exam flat-medium text-primary float-start me-3"></i>
                        <span class="m-0 h5 d-block">580</span>
                        <span class="d-table">Bookmarked Property</span>
                    </div>
                </div>
            </div>
        </div> --}}
        @can('audit_log_access')
            <div class="col">
                <div class="p-30 bg-white border rounded mb-30 clearfix">
                    <h5 class="mb-4">{{ __('Recent Activity') }}</h5>
                    <ul>
                        @foreach($params['activities'] as $_item)
                            <li class="font-13 mb-3">{!! $_item->activity !!}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endcan
    </div>
@endsection