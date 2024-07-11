<header class="header-style nav-on-top bg-white">
    <div class="main-nav">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg nav-secondary nav-primary-hover nav-line-active">
                        <a class="navbar-brand" href="{{ route('homepage') }}"><img class="nav-logo" src="{{ asset('assets/fullwidth/images/logo-new/logo1.png') }}" alt="Image not found !"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon flaticon-menu flat-small text-primary"></span>
                          </button>
                          @include('website.layout.menu', ['showUser' => true])
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>