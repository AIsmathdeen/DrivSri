<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleType;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $role = Auth::user()->getRoleNames()->first();
        //dd($role);
        switch ($role) {
            // case RoleType::SUPER_ADMIN:
            //     return '/account/super-admin/dashboard';
            //     break;
            case RoleType::ADMIN():
                return '/admin/dashboard';
                break;
            case RoleType::LICENSE_HOLDER():
                return '/licensed_holder/dashboard';
                break;
            case RoleType::POLICEMAN():
                return '/policemen/dashboard';
                break;

            default:
                return '';
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
