<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\LicenseHolder;
use App\Enums\RoleType;
use App\Models\LicenseStatus;
use App\Enums\LicenseStatusType;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'license_no' => ['required', 'string', 'max:255','min:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        $user = User::create([
            'email' => $data['email'],
            'license_no'=>$data['license_no'],
            'password' => Hash::make($data['password']),

        ]);
        //dd($user);
        $user->refresh();
        $user->assignRole(RoleType::LICENSE_HOLDER);
        $licenseHolder = new LicenseHolder();
        //$licenseHolder->email = $request->input('email');
        //dd( $licenseHolder->email);
        //$licenseHolder->password = $request->input('password');
        $licenseHolder->user_id = $user->id;
        $licenseHolder->license_no= $user->license_no;
        $licenseHolder->status_id = 1;
        $licenseHolder->save();

        return $user;
    }

}
