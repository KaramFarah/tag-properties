@extends('website.layout.app-blog')
@section('pageTitle', __('Contact') . ' | ' . config('panel.site_title'))
@section('content')
    <!--============== Page title Start ==============-->
    @include('website.layout.title-banner')



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
                                <h6 class="mb-0">Office Address :</h6> Office 1812, Almanara Tower, Business Bay, Dubai, UAE
                            </li>
                            <li class="mb-3">
                                <h6>Contact Number :</h6> (963)  98 870 8915
                            </li>
                            <li class="mb-3">
                                <h6>Email Address :</h6> {{ config('panel.website_email') }}
                            </li>
                        </ul>
                    </div>
                    <h5 class="mb-2">Career Info</h5>
                    <p>If you’re interested in employment opportunities at Unicoder, please email us:<br> <a href="mailto:hr@tagproperties.com">hr@tagproperties.com</a></p>
                </div>
                <div class="col-md-7 order-md-1">
                    <h4 class="down-line mb-4">Send Message</h4>
                    <div class="form-simple">
                        <form id="contact_form" action="{{route('contact-send')}}" method="post" class="form-boder needs-validation" novalidate>
                            @csrf
                            <x-inputs.text inputName="mailer[name]" inputId="name" inputValue="{{old('name')}}" inputLabel="{{__('Full Name')}}" inputRequired="required" class="mb-20"/>
                            <x-inputs.text inputName="mailer[phone]" inputId="phone" inputValue="{{old('phone')}}" inputLabel="{{__('Phone')}}" inputRequired="required" class="mb-20" type="number"/>
                            <x-inputs.text inputName="mailer[email]" inputId="email" inputValue="{{old('email')}}" inputLabel="{{__('Email')}}" inputRequired="required" class="mb-20" type="email"/>
                            <x-inputs.text inputName="mailer[subject]" inputId="subject" inputValue="{{old('subject')}}" inputLabel="{{__('Subject')}}" class="mb-20"/>
                            <x-inputs.textarea inputName="mailer[message]" inputId="message" inputValue="{{old('message')}}" inputLabel="{{__('Message')}}" class="mb-20" inputRequired="required"/>
                            <button 
                                type="submit"
                                data-sitekey="{{config('services.recaptcha_v3.siteKey')}}"
                                data-callback="onSubmit"
                                data-action="submitMessage"
                                id="submit-email" 
                                class="g-recaptcha btn btn-primary"
                                >Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14454.94300298866!2d55.134135!3d25.076944!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2sus!4v1698334168705!5m2!1sar!2sus" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection

@push('scripts')

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            const form = document.getElementById("contact_form");
    
            if (form.checkValidity()) {
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