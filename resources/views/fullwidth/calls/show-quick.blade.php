<div class="text-end mb-30">
    @if($action->allowEdit)
        @can('lead_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.actions.edit', $action->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('lead_delete')
            <form action="{{ route('dashboard.actions.destroy', $action->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
        @can('audit_log_access')
            <a class="btn btn-light viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.actions.index-auditlogs', ['id' => $action->id,'class' => get_class($lead)]) }}">
                <i class="fa fa-edit"></i> {{ __('Activities') }}
            </a>
        @endcan
    @endif
</div>
<div class="row bg-white mb-30">
    <div class="col table-responsive">
        <table class="w-100 items-list bg-transparent">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $action->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Topic') }}</h5>
                    </th>
                    <td>
                        {{ $action->topic ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Status') }}</h5>
                    </th>
                    <td>
                        {{ $action->status ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Summary') }}</h5>
                    </th>
                    <td>
                        {{ $action->summary ?? '' }}
                    </td>
                </tr>
                @can('agent_show')
                    <tr>
                        <th>
                            {{ __('Agent') }}</h5>
                        </th>
                        <td>
                            <a class="btn btn-outline-secondary me-4 mb-1 viewDetails" href="#" data-title="{{ $action->agent->name ?? ''}}" data-value="{{ route('dashboard.agents.show', $action->agent->id) }}">
                                <i class="fa fa-eye"></i>
                                {{ $action->agent->name ?? '' }}
                            </a>
                        </td>
                    </tr>
                @endcan
                <tr>
                    <td colspan="2">
                        @include('fullwidth.partials.interested-show', ['lead' => $action->contact])
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @include('fullwidth.partials.dates-show', ['model' => $action])
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>