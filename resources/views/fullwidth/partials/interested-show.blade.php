<table class="table table-sm">
    <tr>
        <th colspan="4">
            <h5>{{ __('Internal Details') }}:</h5>
        </th>
    </tr>
    <tr>
        <th class="w-25">{{ __('Interested?') }}</th>
        <td colspan="3">{{ $lead->interested ? __('Yes') : __('No') }}</td>
    </tr>
    @if($lead->interested)
        <tr>
            <td class="w-25"><b>{{ __('Financing') }}:</b> {{ Str::ucfirst($lead->financing)}}</td>
            <td class="w-25"><b>{{ __('Budget') }}:</b> {{ Str::ucfirst($lead->budget)}}</td>
            <td class="w-25"><b>{{ __('Looking For') }}:</b> {{ Str::ucfirst($lead->looking_for)}}</td>
        </tr>
        <tr>
            <td><b>{{ __('Client Type') }}:</b> {{ Str::ucfirst($lead->client_type)}}</td>
            <td><b>{{ __('Bedrooms') }}:</b> {{ Str::ucfirst($lead->rooms)}}</td>
            <td><b>{{ __('Resident') }}:</b> {{ Str::ucfirst($lead->resident)}}</td>
        </tr>
        <tr>
            <td colspan="3"><b>{{ __('Expected Purchase Time') }}:</b> {{ $lead->expected_purchase_time ? date('Y-m-d', strtotime($lead->expected_purchase_time)) : '' }}</td>
        </tr>
    @endif
</table>