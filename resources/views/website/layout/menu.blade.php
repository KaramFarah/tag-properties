<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item {{ request()->routeIs('homepage') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('homepage') }}">{{ __('Home') }}</a>
        </li>
        <li class="nav-item dropdown {{ request()->is('properties*') ? 'active' : ''}}">
            <a class="nav-link dropdown-toggle" href="{{ route('properties') }}">{{__('All Properties')}}</a>
            <ul class="dropdown-menu">
                <li class="dropdown">
                    <a class="dropdown-item" href="{{route('properties', ['sproperty_purpose' => 1])}}">{{__('For Sale')}}</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-item" href="{{route('properties', ['sproperty_purpose' => 2])}}">{{__('For Rent')}}</a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ request()->routeIs('developers.*') ? 'active' : ''}}">
            <a class="nav-link dropdown-toggle" href="{{ route('developers.index') }}">{{__('Developers')}}</a>
        </li>
        <li class="nav-item {{ request()->routeIs('projects.index') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('projects.index') }}">{{__('Projects')}}</a>
        </li>
        <li class="nav-item {{ request()->routeIs('about') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('about') }}">{{__('About Us')}}</a>
        </li>
        <li class="nav-item {{ request()->is('blogs*') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('blog.index') }}">{{__('Blogs')}}</a>
        </li>
        {{-- <li class="nav-item {{ request()->routeIs('contact') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('contact') }}">{{__('Contact')}}</a>
        </li> --}}
    </ul>
    @isset($showUser)
        <ul class="navbar-nav sm-mx-none px-3">
            <li class="nav-item dropdown {{ request()->routeIs('profile.details') ? 'active' : ''}}">
                @if(Auth()->guest())
                    <a class="nav-link" href="#"><i class="fas fa-user me-1"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('login')}}"><i class="flaticon-locked flat-mini pe-2"></i> {{__('Login/Register')}}</a></li>
                    </ul>
                @else
                    <a class="nav-link dropdown-toggle" href="#"><i class="fas fa-user me-1"></i></a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="dropdown-item" href="#">Messages</a></li> --}}
                        <li><a class="dropdown-item" href="{{route('profile.details' , ['user' => Auth()->user()->id])}}">{{__('Hi')}},  {{Auth()->user()->name}}</a></li>
                        <li><a class="dropdown-item" href="{{route('profile.details', ['user' => Auth()->user()->id])}}"><i class="flaticon-locked flat-mini pe-2"></i> {{ __('Profile') }}</a></li>
                        @if(Auth()->user()->isAdmiin)
                            <li><a class="dropdown-item" href="{{route('home', ['user' => Auth()->user()->id])}}"><i class="flaticon-locked flat-mini pe-2"></i> {{ __('Profile') }}</a></li>
                        @endif
                        <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform-profile').submit();"><i class="flaticon-transfer flat-mini pe-2"></i> {{ __('Logout') }}</a></li>
                    </ul>
                @endif
            </li>
        </ul>
    @endisset
    <a href="{{ route('contact') }}" class="btn btn-primary add-listing-btn">{{__('Contact')}}</a>
    {{-- <a href="{{route('property-list')}}" class="btn btn-primary add-listing-btn">{{__('List Your Property')}}</a> --}}
</div>