@extends('website.layout.app-blog')
@section('pageTitle', __('Developers') . ' | ' . config('panel.website_title'))
@section('content')
    @include('website.layout.title-banner')
    <div class="full-row py-5">
        <div class="container">
            <div class="row row-cols-md-3 row-cols-1 g-4">
                @foreach($developers as $item)
                    <div class="col">
                        <div class="gallery-one">
                            <div class="photo-overlay d-inline-block">
                                <a href="{{route('developers.show' , ['developer' => $item])}}" class="quick-view transation xy-center m-0">
                                    <span class="flaticon-eye-1 text-primary"></span>
                                </a>
                                <img src="{{ $item->logo }}" alt="real estate template">
                            </div>
                            <div class="portfolio-info mt-3">
                                <div class="portfolio-title">
                                    <div class="portfolio-view float-end"><span class="fa-solid fa-building text-primary flat-mini" title="{{__('Projects')}}"></span> {{ $item->projects->count() }}</div>
                                    <h5 class="font-400 mb-0"><a href="{{route('developers.show' , ['developer' => $item])}}" class="text-secondary">{{ $item->name }}</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const quickViewLinks = document.querySelectorAll('.quick-view');
            quickViewLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const hrefValue = this.getAttribute('href');
                    window.location.href = hrefValue;
                });
            });
        </script>
    @endpush
@endsection