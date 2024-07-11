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
<script src="{{ asset('assets/fullwidth/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/fullwidth/js/custom.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

{{-- <script src="{{asset('assets/fullwidth/js/')}}"></script> --}}
<script src="{{ asset('assets/fullwidth/js/SweetAlert/sweetalert2@11.js') }}"></script>
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
    $(document).ready(function () {
        $('.date').datetimepicker({
            format: 'YYYY/MM/DD',
            widgetPositioning: { horizontal: 'right', vertical: 'bottom'},
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })

        $('.datetime').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss',
            widgetPositioning: { horizontal: 'right', vertical: 'bottom'},
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })

        $('.timepicker').datetimepicker({
            format: 'HH:mm:ss',
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })
        
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

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending...');
        $.ajax({
            data: $('#name').serialize(),
            url: "{{ url('api/tags') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                console.log(data)
                var newOption = new Option(data.tag.name, data.tag.id, false, false)
                            $('#name').append(newOption).trigger('change')
            
            },
            error: function (data) {
                console.log('Error:', data)
                $('#saveBtn').html('Save Changes')
            }
        });
    });





</script>

<script>
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });


      
</script>
<script src="{{asset('assets/fullwidth/js/flatpicker/flatpicker.js')}}"></script>


@stack('scripts')