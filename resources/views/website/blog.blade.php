@extends('website.layout.app-blog')
@section('pageTitle', $local_title . ' | ' . config('panel.website_title'))
@section('content')
    @include('website.layout.title-banner')
    <div class="full-row py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <div class="blog-sidebar widget-box-model">
                        <!-- Search Field -->
                        <div class="widget widget_search">
                            <form role="search" method="get" class="search_form" action="{{route('blog.index', ['tag' => $tag])}}">
                                <label>
                                <span class="screen-reader-text">{{ __('Search for') }}:</span>
                                <input type="search" class="search-field" placeholder="Search …" value="{{old('searchInput', request()->get('search'))}}" name="search">
                            </label>
                                <input type="submit" class="search-submit" value="Search">
                            </form>
                        </div>
                        <!-- Category Field -->
                        <div class="widget widget_categories">
                            <h5 class="widget-title mb-3">{{ __('Categories') }}</h5>
                            <ul>
                                <li><a href="{{route('blog.index', ['search' => request()->get('search')])}}">All</a></li>
                                @foreach ($tags as $_tag)
                                    <li id="{{$_tag->id}}">
                                        <a href="{{route('blog.index' , ['tag' => $_tag->slug, 'search' => request()->get('search')])}}">{{$_tag->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if($recentPosts->count())
                            @include('website.partials.recent_blogs', ['recentBlogs' => $recentPosts]);
                        @endif

                        @if ($recentProperties->count())
                            @include('website.partials.recent_properties')
                        @endif
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1 sm-mb-30">
                    <div class="row row-cols-1 g-4">
                        @forelse ($blogs as $blog)
                            <div class="col">
                                <div class="thumb-blog-horizontal clearfix hover-img-zoom transation border p-2 bg-white">
                                    <div style="display: block; height: auto; background-color: #ccc;" class="post-image overflow-hidden">
                                        <a href="{{route('blog.show' , ['blog' => $blog])}}">
                                            <img src="{{$blog->thumbImage ?? ''}}" alt="Image not found!">
                                        </a>
                                    </div>
                                    <div class="post-content ps-3">
                                        <div class="post-meta font-mini text-uppercase list-color-light">
                                            <a href="{{route('blog.index' , ['tag' => $blog->tags->first()->slug ?? ''])}}">
                                                <span>{{$blog->tags[0]->name ?? ''}}</span>
                                            </a>
                                        </div>
                                        <h5 class="mb-2">
                                            <a href="{{route('blog.show' , ['blog' => $blog])}}" class="transation text-dark hover-text-primary d-block">
                                                {{$blog->title}}</a>
                                        </h5>
                                        <p>{{$blog->description}}</p>
                                        <div class="post-meta font-general">
                                            @if ($blog->creator)
                                                <a name="blog-author"><span>By. {{$blog->creator->name ?? ''}}</span></a>
                                            @endif
                                            <a name="blog-date"><span>{{\Carbon\Carbon::parse($blog->publish_date)->format('d-m-Y')}}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{__('No Blogs!')}}</p>
                        @endforelse
                    </div>
                    <div class="row text-center">
                        <div class="col mt-5 ">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-dotted-active justify-content-center">
                                        {{ $blogs->links() }}
                                </ul>
                            </nav>
                            <span class="woocommerce-ordering-pages me-4 font-fifteen">
                                {!! __('Showing') !!}
                                <span class="fw-semibold">{{ $blogs->links()->paginator->firstItem() }}</span>
                                {!! __('to') !!}
                                <span class="fw-semibold">{{ $blogs->links()->paginator->lastItem() }}</span>
                                {!! __('of') !!}
                                <span class="fw-semibold">{{ $blogs->links()->paginator->total() }}</span>
                                {!! __('results') !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection