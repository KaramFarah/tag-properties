<div class="modal fade" id="addLeadModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addLeadModalLabel">{{ __('Add New Lead')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="lead" id="lead" value="yes">
          <div>
            <x-inputs.text inputName="lead_name" inputId="lead_name" inputLabel="{{ __('Name') }}" inputRequired="" inputValue="{{ old('lead_name', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="lead_email" inputId="lead_email" inputLabel="{{ __('Email') }}" inputRequired="" inputValue="{{ old('lead_email', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="lead_mobile" inputId="lead_mobile" inputLabel="{{ __('Mobile') }}" inputRequired="" inputValue="{{ old('lead_mobile', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.select inputName="lead_campaign" inputLabel="{{ __('Campaign')}}" inputId="lead_campaign" placeholder="{{ __('Campaign') }}" inputValue="" :inputData="$campaigns" inputClass="select2 mb-30 required" showButtons="false" />
          </div>
          <div>
            <x-inputs.select inputName="quality" inputLabel="{{ __('Lead Quality')}}" inputId="quality" placeholder="{{ __('LeadQuality') }}" inputValue="" :inputData="$LeadQuality" inputClass=" mb-30 required" showButtons="false" />
          </div>
          <div>
            <x-inputs.select inputName="lead_priority" inputLabel="{{ __('Lead Priority')}}" inputId="lead_priority" placeholder="{{ __('leadPriority') }}" inputValue="" :inputData="$leadPriority" inputClass=" mb-30 required" showButtons="false" />
          </div>
       
        </div>
        <div class="modal-footer">
          <button type="button" id="saveLead" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')

<script>  
    $(document).ready(function() {

        $("#lead_campaign").select2({
            dropdownParent: $("#addLeadModal"),
            width: '100%'
        })


        var lead_name = $('#lead_name');
        var lead = $('#lead');
        var lead_email = $('#lead_email');
        var lead_mobile = $('#lead_mobile');
        var quality = $('#quality');
        var lead_priority = $('#lead_priority');
        var lead_campaign = $('#lead_campaign');
        $('#saveLead').on('click', function(event) {
            $.ajax({
                url: '{{ route('api.leads.store') }}',
                type: "POST",
                data: { 
                    is_lead:lead.val(),
                    name:lead_name.val(),
                    email:lead_email.val(),
                    mobile:lead_mobile.val(),
                    lead_quality:quality.val(),
                    priority:lead_priority.val(),
                    campaign_id:lead_campaign.val(),
                },
                success: function(response) {
                    console.log(response.data)
                    var newOption = new Option(response.data.name, response.data.id, false, false)
                    $('#contact_id').append(newOption).trigger('change')
                    alert('Added')
                    lead_name.val(' ')
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