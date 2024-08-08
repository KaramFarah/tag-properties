<header class="header-unfix border-bottom bg-white">
    <div class="main-nav xs-p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg nav-secondary nav-primary-hover nav-line-active px-3">
                        <div class="navbar-collapse justify-content-between sm-ml-0">
                            <ul class="navbar-nav sm-mx-none">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#">{{__('Dashboard Options')}}</a>
                                    <ul class="dropdown-menu">
                                        
                                        @can('lead_create')
                                        <li><a class="dropdown-item" href="{{ route('dashboard.leads.create') }}">{{ __('Add Lead') }}</a></li>
                                        @endcan
                                        @can('call_create')
                                        <li><a class="dropdown-item" href="{{ route('dashboard.actions.create') }}">{{ __('Add Action Registery') }}</a></li>
                                        @endcan
                                        @can('unit_create')
                                        <li><a class="dropdown-item" href="{{ route('dashboard.units.create') }}">{{ __('Submit Property') }}</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="flaticon-notification flat-mini"></i></a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="flaticon-comments flat-mini"></i></a>
                                </li> --}}
                            </ul>
                            <ul class="navbar-nav user-option">
                                @if(!Auth::user()->isAgent)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('dashboard.projects.index') }}">{{ __('Projects')}}: <span class="text-primary">{{ $project_count }}</span></a>
                                    </li>
                                @endif
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#"><img src="{{ asset('assets/fullwidth/images/user1.jpg') }}" alt=""> Hi, {{ auth()->user()->name ?? '' }}</a>
                                </li> --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#">
                                        {{-- <img src="{{ asset('assets/fullwidth/images/user1.jpg') }}"alt="user avatar"> --}}
                                         Hi, {{ auth()->user()->name ?? '' }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('homepage')}}"><i class="fa-solid fa-link pe-2"></i>{{__('Website')}}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('profile.password.edit') }}"><i class="flaticon-locked flat-mini pe-2"></i> {{ __('Change Password') }}</a></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="flaticon-transfer flat-mini pe-2"></i> {{ __('Logout') }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<form id="logoutform" action="{{ route('logout') }}" onsubmit="return confirm('{{ __('Are you sure you want to logout now?') }}');" method="POST" class="d-none">
    {{ csrf_field() }}
</form>