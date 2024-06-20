<div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addTagModalLabel">{{ __('Add New Tag')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <x-inputs.text inputName="tag_name" inputId="tag_name" inputLabel="{{ __('Name') }}" inputRequired="" inputValue="{{ old('tag_name', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="saveTag" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')
<script>  
  $(document).ready(function() {
      var tag_name = $('#tag_name');
      $('#saveTag').on('click', function(event) {
          $.ajax({
              url: '{{ route('api.tags.store') }}',
              type: "POST",
              data: { 
                  name:tag_name.val(),
                  type:'interests',
              },
              success: function(response) {
                  console.log(response.data)
                  var newOption = new Option(response.data.name, response.data.id, false, false)
                  $('#tags').append(newOption).trigger('change')
                  alert('Added')
                  tag_name.val(' ')
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