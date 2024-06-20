<div class="page-banner-simple bg-secondary py-50" style="background-image: url({{asset('assets/images/new/bg-1.jpg')}}); background-repeat: no-repeat; background-position: center center; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="banner-title text-white">{{ $local_title ?? config('panel.title') }}</h3>
                <span class="banner-tagline font-medium text-white">{{ $local_description ?? config('panel.title') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="full-row bg-dark py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent list-color-white mb-0">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @isset($breadcrumb['url'])
                                <li class="breadcrumb-item"><a href="{{$breadcrumb['url'] ?? ''}}">{{$breadcrumb['label']}}</a></li>
                            @else
                                <li class="breadcrumb-item">{{$breadcrumb['label']}}</li>
                            @endisset
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<x-session-alert/>