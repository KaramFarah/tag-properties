<div class="full-row py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-secondary">{{ $local_title }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item">
                                @isset($breadcrumb['url'])
                                    <a href="{{$breadcrumb['url'] ?? ''}}">{{$breadcrumb['label']}}</a>
                                @else
                                    {{$breadcrumb['label']}}
                                @endisset
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<x-session-alert />