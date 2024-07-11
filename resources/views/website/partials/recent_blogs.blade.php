<div class="widget widget_recent_entries">
    <h5 class="widget-title mb-3">{{__('Recent Blogs')}}</h5>
    @foreach ($recentBlogs as $post)
        <ul>
            <li>
                <a href="{{route('blog.show' , ['blog' => $post])}}">{{$post->title}}</a>
                <span class="post-date">{{\Carbon\Carbon::parse($post->publish_date)->format('d-m-Y')}}</span>
            </li>
        </ul>                                
    @endforeach
</div>