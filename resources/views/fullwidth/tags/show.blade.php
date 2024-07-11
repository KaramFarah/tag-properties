<div class="row table-responsive">
    <div class="col mb-30">
        <table class="w-100 items-list bg-transparent">
            <tbody>
                <tr class="bg-white">
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $tag->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Parent') }}</h5>
                    </th>
                    <td>
                        {{ $tag->parent->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Type') }}</h5>
                    </th>
                    <td>
                        {{ $tag->type }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Value Type') }}</h5>
                    </th>
                    <td>
                        {{ $tag->valueTypeText }}
                        {{$tag->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_DROPDOWN ? '[' . $tag->value_options . ']': ''}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @include('fullwidth.partials.dates-show', ['model' => $tag])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        @if($tag->allowEdit)
            @can('tag_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.tags.edit', $tag->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
            @endcan
            @can('tag_delete')
                <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
        @endif
    </div>
</div>