<div class="modal fade" id="addFloorModal" tabindex="-1" aria-labelledby="addFloorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addFloorModalLabel">{{ __('Add New Floor')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <x-inputs.text inputName="floor_space" inputId="floor_space" inputLabel="{{ __('Space') }}" inputRequired="" inputValue="{{ old('space', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="floor_matser_bed" inputId="floor_matser_bed" inputLabel="{{ __('Matser Bed') }}" inputRequired="" inputValue="{{ old('matser_bed', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="floor_kitchen" inputId="floor_kitchen" inputLabel="{{ __('Kitchen') }}" inputRequired="" inputValue="{{ old('kitchen', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="floor_dining" inputId="floor_dining" inputLabel="{{ __('Dining') }}" inputRequired="" inputValue="{{ old('dining', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="floor_baths" inputId="floor_baths" inputLabel="{{ __('Baths') }}" inputRequired="" inputValue="{{ old('baths', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="floor_storage" inputId="floor_storage" inputLabel="{{ __('Storage') }}" inputRequired="" inputValue="{{ old('storage', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.textarea inputName="floor_description" inputId="floor_description" inputLabel="{{ __('Description') }}" inputRequired="" inputValue="{{ old('description', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
    
        </div>
        <div class="modal-footer">
          <button type="button" id="saveFloor" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')
<script>  
  $(document).ready(function() {
      let floor_space = $('#floor_space');
      let floor_matser_bed = $('#floor_matser_bed');
      let floor_kitchen = $('#floor_kitchen');
      let floor_dining = $('#floor_dining');
      let floor_baths = $('#floor_baths');
      let floor_storage = $('#floor_storage');
      let floor_description = $('#floor_description');
      let unit_id = 4;
      $('#saveFloor').on('click', function(event) {
          $.ajax({
              url: '{{ route('api.floors.store') }}',
              type: "POST",
              data: { 
                space:floor_space.val(),
                master_bed:floor_matser_bed.val(),
                kitchen:floor_kitchen.val(),
                dining:floor_dining.val(),
                baths:floor_baths.val(),
                storage:floor_storage.val(),
                description:floor_description.val(),
              },
              success: function(response) {
                  console.log(response.data)
                  // var newOption = new Option(response.data.name, response.data.id, false, false)
                  // $('#floors').append(newOption).trigger('change')
                  alert('Added')
                  // floor_name.val(' ')
              },
              error: function (request, status, error) {
                  alert('Error!')
                  // console.log("request: "+request.toJSON())
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