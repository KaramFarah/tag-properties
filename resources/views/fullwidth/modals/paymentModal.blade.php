<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addPaymentModalLabel">{{ __('Add New Payment')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <x-inputs.text inputName="payment_type" inputId="payment_type" inputLabel="{{ __('Type') }}" inputRequired="" inputValue="{{ old('payment_type', '') }}" inputHint="" inputClass="mb-30" type="text"/>
          </div>
          <div>
            <x-inputs.text inputName="payment_milestone" inputId="payment_milestone" inputLabel="{{ __('Milestone') }}" inputRequired="" inputValue="{{ old('payment_milestone', '') }}" inputHint="" inputClass="mb-30" />
          </div>
          <div>
            <x-inputs.text inputName="p_payment" inputId="p_payment" inputLabel="{{ __('Payment') }}" inputRequired="" inputValue="{{ old('p_payment', '') }}" inputHint="" inputClass="mb-30"/>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="savePayment" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')

<script>  
    $(document).ready(function() {
        var payment_type = $('#payment_type');
        var payment_milestone = $('#payment_milestone');
        var p_payment = $('#p_payment');
        $('#savePayment').on('click', function(event) {
            $.ajax({
                url: '{{ route('api.payments.store') }}',
                type: "POST",
                data: { 
                    type:payment_type.val(),
                    milestone:payment_milestone.val(),
                    payment:p_payment.val(),
                },
                success: function(response) {
                    console.log(response.data)
                    var newOption = new Option(response.data.type, response.data.id, false, false)
                    $('#installments').append(newOption).trigger('change')
                    alert('Added')
                    payment_type.val(' ')
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