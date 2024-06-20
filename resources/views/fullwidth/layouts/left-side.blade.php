<div class="dashboard-nav-area bg-light">
    <a class="navbar-brand w-100 d-table px-20 py-3 mb-3" href="{{ route('dashboard.home') }}"><img src="{{ asset('assets/fullwidth/images/logo-new/logo1.png') }}" alt="dashboard logo"></a>
    <div class="collaps-dashboard m-3 px-3 rounded bg-white text-secondary clearfix d-md-none">
        <span>{{ __('Open Dashboard Navigation') }}</span>
        <span class="flaticon-menu text-secondary flat-mini float-end"></span>
    </div>
    <nav class="dashboard-nav nav-light pb-3" id="navbarSupportedContent">
        <ul class="navbar-nav left-collaps-nav">
            @foreach($menuItems as $_key => $_item)
                @can($_item['can'])
                    @isset($_item['items'])
                        <li class="nav-item db-dropdown {{ $_item['active'] ? 'active d-block' : ''}}">
                            <a class="nav-link text-dark dropdown-toggle" href="#"><i class="{{ isset($_item['icon']) ? $_item['icon'] : 'flaticon-star-1 flat-mini' }} pe-2"></i> {!! $_item['label'] !!}</a>
                            <ul class="db-dropdown-menu {{ $_item['active'] ? 'active d-block' : ''}}">
                                @foreach($_item['items'] as $_subItem)
                                    @can($_subItem['can'])
                                        <li class="nav-item {{ $_subItem['active'] ? "active" : "" }}"><a class="nav-link" href="{{ route($_subItem['route']) }}">{!! $_subItem['label'] !!}</a></li>
                                        @endcan
                                @endforeach
                            </ul>
                        </li>
                    @else
                        @isset($_item['route'])
                            <li class="nav-item {{ $_item['active'] ? "active" : "" }}"><a class="nav-link text-dark" href="{{ route($_item['route']) }}"><i class="{{ isset($_item['icon']) ? $_item['icon'] : 'flaticon-star-1 flat-mini' }} pe-2"></i> {!! $_item['label'] !!}</a></li>
                        @else
                            <li class="text-dark pb-2 pt-4 px-20">
                                {!! $_item['label'] !!}
                            </li>
                        @endisset
                    @endisset
                @else
                    @if($_item['can'] == 'public' )
                        <li class="nav-item {{ $_item['active'] ? "active" : "" }}">
                            <a class="nav-link text-dark" href="{{ route($_item['route']) }}">
                                {!! $_item['label'] !!}
                            </a>
                        </li>
                    @endif
                @endcan
            @endforeach
        </ul>
    </nav>
</div>