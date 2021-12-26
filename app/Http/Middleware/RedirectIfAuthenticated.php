<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use App\Enums\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->getRoleNames()->first();
                //dd($role);
                switch ($role) {
                    case RoleType::ADMIN():
                        return redirect('/admin/dashboard');
                        break;
                    case RoleType::LICENSE_HOLDER():
                        return redirect('/licensed_holder/dashboard');
                        break;
                    case RoleType::POLICEMAN():
                        return redirect('/policemen/dashboard');
                        break;
                    default:
                        return '/';
                        break;
                }
            }
        }

        return $next($request);
    }

}



