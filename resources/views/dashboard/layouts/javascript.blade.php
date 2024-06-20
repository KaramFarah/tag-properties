<script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
{{-- <script src='{{ asset('assets/dashboard/libs/preloader-scripts/jquery.preload-1.2.0.min.js') }}'></script> --}}
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
@stack('scripts')