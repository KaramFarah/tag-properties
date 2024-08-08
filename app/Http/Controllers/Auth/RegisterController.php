<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Rules\ReCaptchaV3;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\DashboardHelper;
use App\Otp\UserRegistrationOtp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use SadiqSalau\LaravelOtp\Facades\Otp;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm(){
        $local_title = 'Login / Register';
        $local_description = 'Login or Register to use our online features';
        $role = Role::where('title' , 'Registered')->first()->id;
        return view('fullwidth.auth.register'  , compact('role', 'local_title', 'local_description'));
    }

    public function register(Request $request){
        $local_title = 'Login / Register';
        $local_description = 'Login or Register to use our online features';

        $validator = $request->validate([
            'phone' => 'nullable|unique:contacts,mobile',
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                // :rfc,dns
                'required',
                'email',
                'unique:users,email' . (request()->route('user') ? ',' . request()->route('user')->id : ''),
            ],
            'password' => [
                'required',
            ],
            // 'phone' => ['required' ,'digits:10' , Rule::unique('contacts')]
            // 'g-recaptcha-response' => ['required', new ReCaptchaV3('submitContact')],
        ]);

        if (config('panel.create_lead_register')){

            DashboardHelper::createLead(['name' => $request->get('name'), 'phone' => $request->get('phone'), 'email' => $request->get('email')]);
        }

        $otp = Otp::identifier($request->email)->send(
            new UserRegistrationOtp(
                $request->get('name') ?? '',
                $request->get('email') ?? '',
                $request->get('password') ?? '',
                $request->get('phone') ?? ''
            ),
            Notification::route('mail', $request->email)
        );
        session()->flash('info', __('Check your inbox to get the verfication code.'));

        return view('fullwidth.auth.emailverificationPage' , ['email' => $request->email, 'local_title' => $local_title, 'local_description' => $local_description]);
    }

    public function otpVerfication(Request $request) {
        $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255'],
            'code'     => ['required', 'string']
        ]);
    
        $otp = Otp::identifier($request->email)->attempt($request->code);
    
        if($otp['status'] != Otp::OTP_PROCESSED)
        {
            if($otp['status'] == 'otp.mismatched'){
                session()->flash('danger', 'Wrong verfication code');
                return view('fullwidth.auth.emailverificationPage' , ['email' => $request->email,]);
            }
            else{
                session()->flash('danger', 'Somthing went wrong please try again!');
                return view('fullwidth.auth.emailverificationPage' , ['email' => $request->email ,]);
            }
        }
        
        return redirect()->route('login')->with('success', __('Your account is verfied. You can login now'));
    }
    
    public function otpResend(Request $request) {

        $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255']
        ]);
    
        $otp = Otp::identifier($request->email)->update();
    
        if($otp['status'] != Otp::OTP_SENT)
        {
            abort(403, __($otp['status']));
        }
        return __($otp['status']);
    }

    public function congratulations(){
        
    }
}
