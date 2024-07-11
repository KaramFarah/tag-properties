<div class="row table-responsive">
    <div class="col mb-30">
        <table class="w-100 items-list bg-transparent">
            <tbody>
                <tr class="bg-white">
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $campaign->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Description') }}</h5>
                    </th>
                    <td>
                        {{ $campaign->description }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Start Date') }}</h5>
                    </th>
                    <td>
                        {{ $campaign->start_date ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('End Date') }}</h5>
                    </th>
                    <td>
                        {{ $campaign->end_date ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Network') }}</h5>
                    </th>
                    <td>
                        {{ $campaign->network ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @include('fullwidth.partials.dates-show', ['model' => $campaign])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        @if($campaign->allowEdit)
            @can('campaign_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.campaigns.edit', $campaign->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
            @endcan
            @can('campaign_delete')
                <form action="{{ route('dashboard.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
        @endif
    </div>
</div>