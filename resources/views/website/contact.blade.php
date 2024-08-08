@extends('website.layout.app-blog')
@section('pageTitle', __('Contact') . ' | ' . config('panel.site_title'))
@section('content')
    <!--============== Page title Start ==============-->
    @include('website.layout.title-banner')
    @if($errors->any())
    <div class="notice-danger alert alert-danger alert-dismissible fade show m-3" role="alert">
        @foreach ($errors->all() as $error)
           <p>{{$error}}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    {{-- @if(session()->has('danger'))
        <div class="notice-danger alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session()->get('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    {{-- <div class="notice-danger alert alert-danger alert-dismissible fade show m-3" role="alert">
        Hello
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}


    <!--============== Error Section Start ==============-->


    <!--============== Contact form Start ==============-->
    <div class="full-row py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-md-2">
                    <h4 class="down-line mb-4">Get In Touch</h4>
                    <p>Got questions or looking to explore our services and properties? Contact us via email, phone, or by filling out the form below. Your inquiry will be directed to the right TAG Properties expert, and we'll be in touch within 24 hours.</p>
                    <div class="mb-3">
                        <ul>
                            <li class="mb-3">
                                <h6 class="mb-0">Office Address :</h6>Tishreen University, Lattakia, SY
                            </li>
                            <li class="mb-3">
                                <h6>Contact Number :</h6> (963)  98 870 8915
                            </li>
                            <li class="mb-3">
                                <h6>Email Address :</h6> {{ config('panel.website_email') }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 order-md-1">
                    <h4 class="down-line mb-4">Send Message</h4>
                    <div class="form-simple">
                        {{-- {{route('contact-send')}} --}}
                        <form id="contact_form" action="" method="post" class="form-boder needs-validation" novalidate>
                            @csrf
                            <x-inputs.text inputName="mailer[name]" inputId="name" inputValue="{{old('name')}}" inputLabel="{{__('Full Name')}}" inputRequired="required" class="mb-20"/>
                            <x-inputs.text inputName="mailer[phone]" inputId="phone" inputValue="{{old('phone')}}" inputLabel="{{__('Phone')}}" inputRequired="required" class="mb-20" type="number"/>
                            <x-inputs.text inputName="mailer[email]" inputId="email" inputValue="{{old('email')}}" inputLabel="{{__('Email')}}" inputRequired="required" class="mb-20" type="email"/>
                            <x-inputs.text inputName="mailer[subject]" inputId="subject" inputValue="{{old('subject')}}" inputLabel="{{__('Subject')}}" class="mb-20"/>
                            <x-inputs.textarea inputName="mailer[message]" inputId="message" inputValue="{{old('message')}}" inputLabel="{{__('Message')}}" class="mb-20" inputRequired="required"/>
                            <button
                            class="btn btn-primary"
                                type="submit"
                                data-callback="onSubmit"
                                id="submit-email" 
                                >Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function onSubmit(token) {
            const form = document.getElementById("contact_form");
    
            if (form.checkValidity()) {
                console.log('valid form');
                form.submit();
            } else {

                const forms = document.querySelectorAll('.needs-validation')

                Array.from(forms).forEach(form => {

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')

                })
            }
        }
    </script>
@endpush