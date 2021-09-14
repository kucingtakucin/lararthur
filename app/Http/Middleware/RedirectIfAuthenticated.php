<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // return redirect(RouteServiceProvider::HOME);
        if (Auth::guard($guard)->check()) {
            if (User::find(Auth::guard($guard)->id())->hasRole('admin')) {
                return redirect()->route('backend.admin.dashboard.index');
            } else if (User::find(Auth::guard($guard)->id())->hasRole('operator')) {
                return redirect()->route('backend.operator.dashboard.index');
            }
        }

        return $next($request);
    }
}
