<x-inputs.select inputName="{{$countryName}}" inputLabel="{{$countryLabel}}" inputId="{{$countryId}}" placeholder="{{ __('Select Country') }}" :inputValue="old('{{$name}}',  $selected_country ?? '')" :inputData="$countries" inputClass="select2 country" showButtons="false" class="mb-30"/>
@push('scripts')
  <script>
      function format(item, state) {
      if (!item.id) {
          return item.text;
      }
      var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
      var stateUrl = "https://oxguy3.github.io/flags/svg/us/";
      var url = state ? stateUrl : countryUrl;
      var img = $("<img>", {
          class: "img-flag pe-10",
          width: 26,
          src: url + item.element.value.toLowerCase() + ".svg"
      });
      var span = $("<span>", {
          text: " " + item.text
      });
      span.prepend(img);
      return span;
      }

      $(document).ready(function() {
        $(".country").select2({
            templateResult: function(item) {
              return format(item, false);
            } 
          });
      });
  </script>
@endpush