<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="table-responsive">
                    <table class="w-100 items-list bg-transparent">
                        <thead>
                            <tr class="bg-white">
                                <th>
                                    #
                                </th>
                                <th>
                                    {{ __('Description') }}
                                </th>
                                <th>
                                    {{ __('User') }}
                                </th>
                                <th>
                                    {{ __('Host') }}
                                </th>
                                <th>
                                    {{ __('Created At') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($_offset = 1)
                            @forelse($items as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    <td>
                                        {{ $_offset+(request()->input('page') > 1 ? (request()->input('page')-1)*100 : 0) }}
                                    </td>
                                    <td>
                                        <h5 class="text-secondary font-400">{{ $item->description }}</h5>
                                    </td>
                                    <td>
                                        {{ $item->user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item->host }}
                                    </td>
                                    <td>
                                        {{ $item->created_at }}
                                    </td>
                                </tr>
                                @php($_offset++)
                            @empty
                                <tr>
                                    <td colspan="8">Empty</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>