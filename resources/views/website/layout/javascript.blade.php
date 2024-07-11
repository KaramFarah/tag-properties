<script src="{{ asset('assets/fullwidth/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/greensock.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/layerslider.transitions.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/layerslider.kreaturamedia.jquery.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/owl.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/range/tmpl.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/range/jquery.dependClass.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/range/draggable.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/range/jquery.slider.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/wow.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/paraxify.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/custom.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#slider').layerSlider({
            sliderVersion: '6.0.0',
            type: 'fullwidth',
            responsiveUnder: 0,
            maxRatio: 1,
            slideBGSize: 'auto',
            hideUnder: 0,
            hideOver: 100000,
            skin: 'outline',
            fitScreenWidth: true,
            fullSizeMode: 'fitheight',
            navButtons: false,
            navStartStop: false,
            height:840,
            skinsPath: 'assets/skins/'
        });

    // function toggleIconClass(icon) {
    //     if (icon.classList.contains("fa") && icon.classList.contains("fa-heart")) {
    //         icon.classList.remove("fa");
    //         icon.classList.remove("fa-heart");
    //         icon.classList.add("flaticon-like-1");
    //     } else if (icon.classList.contains("flaticon-like-1")) {
    //         icon.classList.remove("flaticon-like-1");
    //         icon.classList.add("fa");
    //         icon.classList.add("fa-heart");
    //     }
    // }
    function toggleIconClass(icon) {
    var link = icon.parentNode.getAttribute("link");
    if (icon.classList.contains("fa") && icon.classList.contains("fa-heart")) {
        icon.classList.remove("fa");
        icon.classList.remove("fa-heart");
        icon.classList.add("flaticon-like-1");
        // Submit the link
        window.location.href = link;
    } else if (icon.classList.contains("flaticon-like-1")) {
        icon.classList.remove("flaticon-like-1");
        icon.classList.add("fa");
        icon.classList.add("fa-heart");
        // Submit the link
        window.location.href = link;
    }
    event.preventDefault();
    }

</script>
<script src="{{ asset('assets/fullwidth/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/SweetAlert/sweetalert2@11.js') }}"></script>



<script>
    $(document).ready(function () {
        
        $('.select-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })

        $('.select2').select2({
            width: '100%'
        })
    })

    const toastElList = document.querySelectorAll('.toast')
    const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option))
</script>

@stack('scripts')

{{-- @if(Str::endsWith(env('APP_URL'), 'tagproperties.com'))
    <script src="//code.tidio.co/szg2dp3h54bp0hdra3zcenr0eskpcxbt.js" async></script>
@endif --}}