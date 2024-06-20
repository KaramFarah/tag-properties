@extends('website.layout.app-blog')
@section('pageTitle', $local_title . ' | ' . __('Blogs') . ' | ' . config('panel.website_title'))
@section('content')
    @include('website.layout.title-banner')
    <div id="page_wrapper" class="bg-light">
        <div class="full-row py-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 order-xl-2">
                        <div class="blog-sidebar widget-box-model">
                            <!-- Search Field -->
                            <div class="widget widget_search">
                                <form role="search" method="get" class="search_form" action="http://localhost/axeman-wp/">
                                    <label>
									<span class="screen-reader-text">{{ __('Search for') }}:</span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s">
								</label>
                                    <input type="submit" class="search-submit" value="Search">
                                </form>
                            </div>
                            <!-- Category Field -->
                            <div class="widget widget_categories">
                                <h5 class="widget-title mb-3">Categories</h5>
                                <ul>
                                    <li><a href="{{route('blog.index')}}" id="all-tags-tabe">All</a></li>
                                    @foreach ($tags as $tag)
                                        @if ($tag->slug)
                                            <li><a href="{{route('blog.index' , ['tag' => $tag])}}" id="{{$tag->id}}">{{$tag->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @includeWhen(isset($recentPosts), 'website.partials.recent_blogs', ['recentBlogs' => $recentPosts])
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1 sm-mb-30">
                        <div class="single-post border summary bg-white p-30 mb-30">
                            <div class="single-post-title">
                                <a href="{{route('blog.index' , ['tag' => $blog->tags->first()->slug])}}">
                                    <span class="d-inline-block text-primary">{{$blog->tags->first()->name ?? ''}}</span>
                                </a>
                                <h4 class="mb-3 text-secondary">{{$blog->title}}</h4>
                                <p>{!!$blog->description!!}</p>
                                <div class="post-meta list-color-general mb-4">
                                    @if ($blog->creator)
                                        <a name="blog-author"><i class="flaticon-user-silhouette flat-mini"></i> <span>By. {{$blog->creator->name ?? ''}}</span></a>
                                    @endif
                                    
                                    <a name="blog-date"><i class="flaticon-calendar flat-mini"></i> <span>{{\Carbon\Carbon::parse($blog->publish_date)->format('d-m-Y')}}</span></a>
                                    {{-- <a href="#"><i class="flaticon-comments flat-mini"></i> <span>02</span></a>
                                    <a href="#"><i class="flaticon-like flat-mini"></i> <span>30</span></a>
                                    <a href="#"><i class="flaticon-eye-1 flat-mini"></i> <span>731</span></a>
                                    <span><i class="flaticon-document flat-mini"></i> <a href="#"><span>General</span></a>,<a href="#"><span>Media</span></a></span> --}}
                                </div>
                            </div>
                            <div class="post-image">
                                <img src="{{$blog->fullImage ?? ''}}" alt="{{$blog->title}} image">
                            </div>
                            <div class="post-content pt-4 mb-5">
                                {!!$blog->content!!}
                            </div>
                            <div class="tagcloud">
                                <h6 class="mb-3">Tags:</h6>
                                <ul>
                                    <li><a href="{{route('blog.index' , ['tag' => $blog->tags->last()])}}">{{$blog->tags->last()->name}}</a></li>
                                </ul>
                            </div>
                            <div class="share-post border-0 px-0 d-flex mt-5">
                                <span class="py-10"><b>Share:</b></span>
                                {{-- {{dd($links)}} --}}
                                <div class="media-widget-round-white-primary-shadow">
                                    <a href={{$links['facebook']}}><i class="fab fa-facebook-f"></i></a>
                                    {{-- <a href="#"><i class="fab fa-twitter"></i></a> --}}
                                    <a href={{$links['linkedin']}}><i class="fab fa-linkedin-in"></i></a>
                                    <a href={{$links['whatsapp']}}><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection