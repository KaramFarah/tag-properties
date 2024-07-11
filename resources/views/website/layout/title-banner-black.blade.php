<div class="page-banner-simple bg-secondary py-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="banner-title text-white">{{ $local_title ?? config('panel.title') }}</h3>
                <span class="banner-tagline font-medium text-white">{{ $local_description ?? config('panel.title') }}</span>
            </div>
        </div>
    </div>
</div>
<x-session-alert/>