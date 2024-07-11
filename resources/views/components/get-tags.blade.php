<div>
    <ul>
        <li><a href="{{route('blog.index')}}">All</a></li>
        @foreach ($Tags as $key => $tag)
        @if ($key)
                <li id="{{$tag}}"><a href="{{route('blog.index' , ['tag' => $key])}}">{{$tag}}</a></li>
            @endif
        @endforeach
    </ul>
</div>