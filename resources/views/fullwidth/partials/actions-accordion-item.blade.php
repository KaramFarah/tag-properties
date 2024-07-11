@can('call_access')
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#actions" aria-expanded="false" aria-controls="actions">
                <h5>{{ __('Actions') }}</h5>
            </button>
        </h2>
        <div id="actions" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
            <div class="accordion-body">
                <table class="table w-100 items-list bg-transparent">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Date & Time') }}</th>
                            <th scope="col">{{ __('Type') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Agent') }}</th>
                            <th scope="col">{{ __('Feedback') }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($actions as $_item)
                            <tr>
                                <td>{{ date('Y-m-d H:i', strtotime($_item->date)) }}</td>
                                <td>{{ Str::ucfirst($_item->type) }}</td>
                                <td>{{ Str::ucfirst($_item->status) }}</td>
                                <td>{{ $_item->agent->name ?? '' }}</td>
                                <td>{{ Str::limit($_item->summary, 15) }}</td>
                                
                                <td>
                                    @can('call_show')
                                        <a class="text-primary  me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.actions.show-quick', $_item->id) }}" data-title="{{$_item->title}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">{{__('No actions')}}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endcan