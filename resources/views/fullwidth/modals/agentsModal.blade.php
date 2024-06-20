<div class="modal fade" id="addAgentModal" tabindex="-1" aria-labelledby="addAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addAgentModalLabel">{{ __('Add New Agent')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <x-inputs.text inputName="agent_name" inputId="agent_name" inputLabel="{{ __('Name') }}" inputRequired="" inputValue="{{ old('agent_name', '') }}" inputHint="" inputClass="mb-30 border" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="agent_email" inputId="agent_email" inputLabel="{{ __('Email') }}" inputRequired="" inputValue="{{ old('agent_email', '') }}" inputHint="" inputClass="mb-30 border" type="email"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="saveAgent" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')
<script>  
  $(document).ready(function() {
      var agent_name = $('#agent_name');
      var agent_email = $('#agent_email');
      $('#saveAgent').on('click', function(event) {
          $.ajax({
              url: '{{ route('api.agents.store') }}',
              type: "POST",
              data: { 
                  name:agent_name.val(),
                  email:agent_email.val(),
                  
              },
              success: function(response) {
                  console.log(response.data)
                  var newOption = new Option(response.data.name, response.data.id, false, false)
                  $('#agent_id').append(newOption).trigger('change')
                  alert('Added')
                  agent_name.val(' '),
                  agent_email.val(' ')
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