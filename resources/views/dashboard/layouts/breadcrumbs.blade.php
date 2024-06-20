<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $_item)
            @isset($_item['url'])
                <li class="breadcrumb-item float-sm-right"><a href="{{ $_item['url'] }}">{{ $_item['label'] }}</a></li>
            @else
                <li class="breadcrumb-item float-sm-right active">{{ $_item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>