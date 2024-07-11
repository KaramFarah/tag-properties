<div class="row table-responsive">
    <div class="col mb-30">
        <table class="w-100 items-list bg-transparent">
            <tbody>
                <tr class="bg-white">
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $blog->id }}
                    </td>
                </tr>
                {{-- <tr>
                    <th>
                        {{ __('Title') }}</h5>
                    </th>
                    <td>
                        <h5 class="text-secondary font-400">{{ $blog->title }}</h5>
                    </td>
                </tr> --}}
                <tr>
                    <th>
                        {{ __('Author') }}</h5>
                    </th>
                    <td>
                        {{ $blog->user->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Publish Date') }}
                    </th>
                    <td>
                        {{ $blog->publish_date }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Tags') }}</h5>
                    </th>
                    <td>
                        @foreach ($blog->tags as $key => $tag)
                        <span class="badge bg-info fs-6 m-1">{{$blog->tags[$key]->name}}</span>  
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Description') }}</h5>
                    </th>
                    <td>
                        {{ $blog->description }}
                    </td>
                </tr>
 
                <tr>
                    <th>
                        {{ __('Content') }}</h5>
                    </th>
                    <td>
                        {!! $blog->content !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Link') }}</h5>
                    </th>
                    <td>
                        {{ $blog->link }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Slug') }}</h5>
                    </th>
                    <td>
                        {{ $blog->slug }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>{{ __('Photos') }}</b>:</td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if($blog->fullImage)
                            <a href="{{ $blog->fullImage}}" target="blank">
                                <img src="{{ $blog->fullImage }}" alt="{{ $blog->getMedia('blog-photos')->first()->name ?? '' }}" class="w-100 border rounded">
                            </a>
                        @else
                            {{ __('No photo') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @include('fullwidth.partials.dates-show', ['model' => $blog])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        @if($blog->allowEdit)
            @can('blog_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.blogs.edit', $blog->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
            @endcan
            @can('blog_delete')
                <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
        @endif
    </div>
</div>