@can('comment_access')
    @if(!isset($show_btn))
        <h5>{{ __('Comments') }}</h5>
    @endif
    @if(count($comments))
        <table class="table table-striped">    
            <thead>
                <tr>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Comment') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>
                            {{ $comment->creator->name ?? '' }}
                        </td>
                        <td>
                            {{$comment->publish_date}}
                        </td>
                        <td class="w-50">
                            {{ $comment->content }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endcan
@can('comment_create')
    @if(isset($show_btn))
        <form action="{{route('dashboard.comments.store')}}" method="POST" class="form-boder">
            @method('POST')
            @csrf
            @if(isset($ref_id) && $ref_id)
                <input type="hidden" name="id" value="{{ $ref_id }}">
            @endif
            @if (isset($call_id) && $call_id) 
                <input type="hidden" name="call_id" value="{{ $call_id }}">
            @endif
            <x-inputs.text inputAttributes="maxlength=255" inputName="content" inputId="content" inputLabel="{{ __('New Comment') }}" inputRequired="required" inputValue="" inputHint="" inputClass="" class="mb-30" type="text"/>
            <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> {{ __('Add Comment') }}</button>
        </form>
    @else
        <x-inputs.text inputAttributes="maxlength=255" inputName="content" inputId="content" inputLabel="{{ __('New Comment') }}" inputValue="" inputHint="" inputClass="" class="mb-30" type="text"/>
    @endif
@endcan