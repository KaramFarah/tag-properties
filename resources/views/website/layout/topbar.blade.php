<header class="header-style-1 nav-on-banner fixed-bg-white">
    <div class="top-header xs-mx-none">
        <div class="container">
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <ul class="top-contact list-color-white">
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Need Support ? +963 98 870 8915</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="nav-bar-top right list-color-white d-flex">
                        @if (Auth::guest())
                            
                        @else
                            @if(auth()->user()->isAdmin || auth()->user()->isAgent)
                                <li><a href="{{route('profile.details' , ['user' => Auth()->user()->id])}}">Dashboard</a></li>
                            @endif
                        @endif
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li><a href="{{route('profile.details' , ['user' => Auth()->user()->id])}}">Hi, {{Auth::user()->name}}</a></li>
                        @endif
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                        <li>
                            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav id="main-navbar" class="navbar navbar-expand-lg nav-white nav-primary-hover nav-line-active">
                        <a class="navbar-brand" href="{{ route('homepage') }}"><img class="nav-logo" src="{{ asset('assets/fullwidth/images/logo-new/logo1.png') }}" alt="Image not found !"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon flaticon-menu flat-small text-primary"></span>
                            </button>
                            @include('website.layout.menu')
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>