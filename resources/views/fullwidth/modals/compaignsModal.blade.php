<div class="modal fade" id="addCampaignModal" tabindex="-1" aria-labelledby="addCampaignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addCampaignModalLabel">{{ __('Add New Campaign')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <x-inputs.text inputName="campaign_name" inputId="campaign_name" inputLabel="{{ __('Name') }}" inputRequired="" inputValue="{{ old('campaign_name', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="campaign_start_date" inputId="campaign_start_date" inputLabel="{{ __('Start Date') }}" inputRequired="" inputValue="{{ old('campaign_start_date', '') }}" inputHint="" inputClass="mb-30" type="date"/>
          </div>
          <div>
            <x-inputs.text inputName="campaign_end_date" inputId="campaign_end_date" inputLabel="{{ __('End Date') }}" inputRequired="" inputValue="{{ old('campaign_end_date', '') }}" inputHint="" inputClass="mb-30" type="date"/>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="saveCampaign" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')

<script>  
    $(document).ready(function() {
        var campaign_name = $('#campaign_name');
        var campaign_start_date = $('#campaign_start_date');
        var campaign_end_date = $('#campaign_end_date');
        $('#saveCampaign').on('click', function(event) {
            $.ajax({
                url: '{{ route('api.campaigns.store') }}',
                type: "POST",
                data: { 
                    name:campaign_name.val(),
                    start_date:campaign_start_date.val(),
                    end_date:campaign_end_date.val(),
                },
                success: function(response) {
                    console.log(response.data)
                    var newOption = new Option(response.data.name, response.data.id, false, false)
                    $('#campaign_id').append(newOption).trigger('change')
                    alert('Added')
                    campaign_name.val(' ')
                },
                error: function (request, status, error) {
                    alert('Error!')
                    console.log("request: "+request.toJSON())
                    console.log("status: "+status)
                    console.log("error: "+error)
                }
            });
            event.preventDefault();
            return false;
        });
    });

</script>

@endpush