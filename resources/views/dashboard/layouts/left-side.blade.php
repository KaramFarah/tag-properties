<div class="col-md-2 bg-light py-3">
    <nav id="sidebarMenu" class="d-md-block sidebar collapse">
        <div class="position-sticky sidebar-sticky">
            @auth
                <ul class="nav flex-column">
                    @foreach($menuItems as $_key => $_item)
                        @can($_item['can'])
                            <li class="mb-1">
                                @isset($_item['items'])
                                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#{{ $_key }}-collapse" aria-expanded="false">
                                        {{ $_item['label'] }}
                                    </button>
                                    <div class="collapse {{ $_item['active'] ? 'show' : ''}}" id="{{ $_key }}-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            @foreach($_item['items'] as $_subItem)
                                                @can($_subItem['can'])
                                                    <li class="nav-item">
                                                        <a href="{{ route($_subItem['route']) }}" class="nav-link text-decoration-none rounded{{ $_subItem['active'] ? ' show fw-bold' : ''}}"><i class="bi bi-circle{{ $_subItem['active'] ? '-fill' : ''}} pe-2"></i> {{ $_subItem['label'] }}</a>
                                                    </li>
                                                @endcan
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ isset($_item['route']) ? route($_item['route']) : '#' }}" class="btn btn-light border-0 d-inline-flex text-decoration-none rounded {{ $_item['active'] ? 'active' : '' }}">{!! $_item['label'] !!}</a>
                                @endisset
                            </li>
                        @endcan
                    @endforeach
                    @can('advanced_access')
                        <hr>
                        <li class="mb-1 nav-item">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#admin-collapse" aria-expanded="{{ request()->routeIs('dashboard.audit-logs.index') || request()->routeIs('dashboard.change-log') ? "true" : "false" }}">
                                {{ __('Advanced') }}
                            </button>
                            <div class="collapse{{ request()->routeIs('dashboard.audit-logs.*') || request()->routeIs('dashboard.clear-cache') || request()->routeIs('dashboard.change-log') ? " show" : "" }}" id="admin-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @can('audit_log_access')
                                        <li class="nav-item"><a href="{{ route('dashboard.audit-logs.index') }}" class="nav-link d-inline-flex text-decoration-none rounded {{ request()->routeIs('dashboard.audit-logs.*') ? "collapsed active" : "" }}"><i class="bi bi-circle{{ request()->routeIs('dashboard.audit-logs.*') ? "-fill" : "" }} pe-2"></i>{{ __('Audit Logs')}}</a></li>
                                    @endcan
                                    @can('change_log_access')
                                        <li class="nav-item"><a href="{{ route('dashboard.change-log') }}" class="nav-link d-inline-flex text-decoration-none rounded {{ request()->routeIs('dashboard.change-log') ? "collapsed active" : "" }}"><i class="bi bi-circle{{ request()->routeIs('dashboard.change-log') ? "-fill" : "" }} pe-2"></i>{{ __('Change Log')}}</a></li>
                                    @endcan
                                    @can('clear_cache_access')
                                        <li class="nav-item"><a href="{{ route('dashboard.clear-cache') }}" class="nav-link d-inline-flex text-decoration-none rounded {{ request()->routeIs('dashboard.clear-cache') ? "collapsed active" : "" }}"><i class="bi bi-arrow-clockwise pe-2"></i>{{ __('Mass Cache Clear')}}</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                </ul>
                <hr>
                <div class="dropdown position-relative bottom-0">
                    <a href="#" class="d-flex align-items-center btn btn-outline-dark dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name ?? '' }}
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                            @can('profile_password_edit')
                                <li><a class="dropdown-item" href="{{ route('profile.password.edit') }}"><i class="bi bi-person-circle me-1"></i>{{ __('Change Password') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endcan
                        @endif
                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="dropdown-item notify-item text-danger">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>{{ __('Logout') }}</span>
                        </a></li>
                    </ul>
                </div>
            @else
                <div class="">
                    <p class="fs-5 m-3">{{ __('You are viewing this as guest') }}</p>
                    <hr>
                    <div class="position-relative bottom-0 p-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-success border-0 d-inline-flex text-decoration-none rounded"><i class="bi bi-box-arrow-in-right pe-2"></i>{{ __('Login') }}</a>
                    </div>
                </div>
            @endauth
        </div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" class="d-none">
            {{ csrf_field() }}
        </form>
    </nav>
</div>