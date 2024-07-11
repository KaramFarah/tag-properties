@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.2/build/css/intlTelInput.css">
@endsection

<div class="input-group mb-30">
    <label for="phone" class="form-label ">{{__('Phone')}}</label>
    <input class="form-control" placeholder="Enter your phone number" type="text" id="phone_input" name="phone" value="{{old('phone', $agent->phone ?? '')}}">
    <span id="phone_error" class="error-message text-danger"></span>
</div>
{{-- <input class="form-control mb-30" placeholder="Enter your phone number" type="text" id="phone_input" name="phone" value="{{old('phone', $agent->phone ?? '')}}"> --}}
{{-- <span id="valid-msg" class="hide">✓ Valid</span>
<span id="error-msg" class="hide"></span> --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.2/build/js/intlTelInput.min.js"></script>

    <script>
        const input = document.querySelector("#phone_input");
        // const phoneError = document.querySelector("#phone_error");
        let iti = window.intlTelInput(input, {
            nationalMode:false,
            autoInsertDialCode:true,
            autoPlaceholder:"aggressive",
            containerClass:"w-100",
            initialCountry:"AE",
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.2/build/js/utils.js",
        });
        // validation
        // function validatePhoneNumber() {
        //     const isValid = iti.isValidNumber();
        //     if (!isValid) {
        //         phoneError.textContent = "Invalid phone number";
        //     } else {
        //         phoneError.textContent = "";
        //     }
        // }
        // input.addEventListener("input", validatePhoneNumber);
    </script>
    
@endpush