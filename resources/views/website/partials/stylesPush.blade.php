@section('styles')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("mail_form").submit();
        }
    </script>
    <link rel="stylesheet" href="{{asset('assets/fullwidth/css/wizard/styles.css')}}">
    <script src="{{ asset('assets/fullwidth/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
        selector: '#description'
        });
    </script>
@endsection