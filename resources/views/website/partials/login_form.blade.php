<div class="row">
    <div class="col">
        <div class="bg-white xs-p-20 p-30 border rounded">
            <div class="form-icon-left rounded form-boder">
                <h4 class="mb-4">{{ __('User Login') }}</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf                        
                    <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" inputValue="{{ isset(request()->wrongEmail) ? request()->wrongEmail : (isset($registeredUser) ? $registeredUser->email : ( old('email', $email ?? ''))) }}" class="mb-30"/>
                    <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="password" inputId="password" inputLabel="{{ __('Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" class="mb-30" inputValue="{{ old('password', $password ?? '') }}" type="password"/>
                    <ul class="custom-check-box mb-30">
                        <li>
                            <input id="feature-rememberme" class="custom-control-input hide" type="checkbox">
                            <label class="text-secondary" for="feature-rememberme">{{ __('Remember Me') }}</label>
                        </li>
                    </ul>
                    <div class="mb-30 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-30">
                                <a href="{{ route('password.request') }}" class="text-dark d-table py-1">{{ __('Forgot Password?') }}</a>
                            </div> 
                        </div>
                        <div class="col text-end">
                            {{-- <form action=""></form> --}}
                            <a href="{{route('register')}}" class="text-dark"><h5>{{ __('Sign Up Here') }}</h5></a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>