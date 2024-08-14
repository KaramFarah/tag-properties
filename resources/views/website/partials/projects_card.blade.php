<div class="row">
    <div class="col">
        <div class="align-items-center d-flex">
            <div class="me-auto">
                <h2 class="d-table">{{__('Developer\'s Projects')}}</h2>
            </div>
        </div>
    </div>
</div>
<div class="row row-cols-1 g-4">
    @foreach ($projects as $project)
        <div class="col">
            <!-- Projects Grid -->
            <div class="property-list-1 bg-white property-block border rounded transation-this hover-shadow p-2">
                <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                    <div class="cata position-absolute">
                        <span class="sale bg-primary text-white">{{$project->statusText}}</span></div>
                    <div class="owl-carousel single-carusel dot-disable nav-between-in">
                        @if (empty($project->allPhotos))
                            <div class="item">
                                <a href="{{route('projects.show' , ['project' => $project])}}"><img src="{{asset('assets/images/new/property-grid-1.jpg')}}" alt="{{$project->name}} cover image"></a>
                            </div>
                        @else
                            @foreach ($project->allPhotos as $photo)
                                <div class="item">
                                    {{-- asset('assets/images/new/property-grid-1.jpg') --}}
                                    <a href="{{route('projects.show' , ['project' => $project])}}"><img src="{{$photo->getUrl('website')}}" alt="{{$project->name}} cover image"></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <ul class="position-absolute quick-meta">
                    </ul>
                </div>
                <div class="property_text px-3">
                    <div class="post-meta font-small text-uppercase list-color-primary">
                        <a href="{{route('projects.show' , ['project' => $project])}}" class="listing-ctg"><i class="fa-solid fa-building"></i><span>{{$project->project_type}}</span></a>
                    </div>
                    <h5 class="listing-title"><a href="{{route('projects.show' , ['project' => $project])}}">{{$project->name}}</a></h5>
                    <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$project->fullLocation}} </span>
                    <div class="entry-footer">
                        <span class="listing-price">@if ($project->minPrice) {{'Starts At: '}}{{config('panel.currency')}} {{$project->minPrice}}@endif</span>
                    </div>
                </div>
            </div>
        </div>                                    
    @endforeach
</div>