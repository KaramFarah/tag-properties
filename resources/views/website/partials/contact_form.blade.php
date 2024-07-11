<div class="widget widget_contact bg-white border p-30 shadow-one rounded mb-30">
    @if (Route::currentRouteName() === 'propertyShow')
        @isset($unit->creator)
            <h5 class="mb-4">{{ __('Listed By') }}</h5>
            <div class="media mb-3">
                <img class="rounded-circle me-3" src="{{ asset('assets/fullwidth/images/user1.jpg') }}" alt="avata">
                <div class="media-body">
                    <div class="h6 mt-0">{{$unit->creator->name ?? ''}}</div>
                    @if (auth()->user())
                        <div class="row">
                            <div class="col">
                                <span>{{$unit->creator->email ?? ''}}</span>
                            </div>
                            <div class="col">
                                <span>{{$unit->creator->phone ??  'No phone Info'}}</span>
                            </div>
                        </div>
                    @else
                        <span><i>{{__('Login to access agent details')}}</i></span>
                    @endif
                </div>
            </div>
        @endisset
    @else
        <h5 class="mb-4">{{ __('Contact Us') }}</h5>
    @endif
    <form class="form-icon-right form-boder" id="get_help_form" action="{{route('mail')}}" method="post">
        @csrf
        <div class="row">
            <input type="hidden" id="mailer_subject" name="mailer[subject]" value="Inquiry about a property">
            <div class="col-12">
                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="mailer[name]" inputId="name" inputPlaceholder="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', Auth::user()->name ?? '') }}" class="mb-3"/>
            </div>
            <div class="col-12">
                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="mailer[phone]" inputId="phone" inputPlaceholder="{{ __('Phone') }}" inputValue="{{ old('phone', Auth::user()->phone ?? '') }}" class="mb-3"/>
            </div>
            <div class="col-12">
                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="mailer[email]" inputId="email" inputPlaceholder="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', Auth::user()->email ?? '') }}" class="mb-3"/>
            </div>
            <div class="col-12">
                <x-inputs.textarea inputLabelClass="font-fifteen font-500" inputName="mailer[message]" inputId="message" inputPlaceholder="{{ __('Message') }}" inputRequired="required" inputValue="{{ old('message') }}" class="mb-3"/>
            </div>
            <div class="col-12">
                <div class="form-group mb-0">
                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                        >{{__('Send')}}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        // $(document).ready(function() {
        //     let _name = $('#mailer_name');
        //     let _email = $('#mailer_email');
        //     let _subject = $('#mailer_subject');
        //     let _message = $('#mailer_message');
        //     let _phone = $('#mailer_phone');
        //     $('#submit-email').on('click', function(event) {
        //         $.ajax({
        //             url: '{{route('mail')}}',
        //             type: "POST",
        //             data: { 
        //                 mailer_name   :mailer.val(),
        //                 mailer_email  :_email.val(),
        //                 mailer_subject:_subject.val(),
        //                 mailer_message:_message.val(),
        //                 mailer_phone:_message.val(),

        //             },
        //             success: function(response) {
        //                 var responseObject = JSON.parse(response);
        //                 console.log(response);
        //                 console.log(responseObject.status);
        //                 if (responseObject.status == 200){
        //                 swal({
        //                     title: "Email Sent!",
        //                     text: "Suceess message sent successfully!!",
        //                     icon: "success",
        //                     button: "Ok",
        //                     timer: 2000
        //                 });
        //                 }
        //                 else if(responseObject.status == 500)
        //                 {
        //                     swal({
        //                     icon: "error",
        //                     title: "Oops...",
        //                     text: "Something went wrong!",
        //                     // footer: '<a href="#">Why do I have this issue?</a>'
        //                     });
        //                 }
        //             },
        //             error: function (request, status, error) {
        //                 swal({
        //                 icon: "error",
        //                 title: "Oops...",
        //                 text: "Something went wrong!",
        //                 footer: '<a href="#">Why do I have this issue?</a>'
        //                 });
        //             }
        //         });
        //         event.preventDefault();
        //         return false;
        //     });
        // })
    </script>
@endpush