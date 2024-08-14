<div class="widget widget_recent_property">
    <h5 class="text-secondary mb-4">{{__('Recent Projects')}}</h5>
    <ul>
        @foreach ($recentProjects as $_project)
            <li>
                <img src="{{$_project->coverImage ?? asset('assets/images/new/property-grid-1.jpg')}}" alt="{{$_project->name}} thumbnail image">
                <div class="thumb-body">
                    <h6 class="listing-title"><a href="{{route('projects.show', ['project' => $_project])}}">{{$_project->name}}</a></h6>
                    <span class="listing-price">{{config('panel.currency')}}{{$_project->minPrice}}<small>( {{$_project->statusText}} )</small></span>
                    <ul class="d-flex quantity font-fifteen">
                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$_project->minSize}} Sqft</li>
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</div>