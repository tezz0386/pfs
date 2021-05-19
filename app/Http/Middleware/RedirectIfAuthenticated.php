<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
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
    public function handle(Request $request, Closure $next, $guard = null)
    {
         switch ($guard) {
            case 'admin':
                $link="/admin";
                break;
            case 'super':
                 $link="/super";
                break;
            default:
                  $link ="/home";
                break;
        }
        if (Auth::guard($guard)->check()) {
            return redirect($link);
        }

        return $next($request);
    }
}
