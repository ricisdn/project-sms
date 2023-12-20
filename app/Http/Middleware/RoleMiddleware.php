<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role) {
        if(Auth::check() && in_array(Auth::user()->usertype, $role)) {
            return $next($request);
        }

        Session::flash('error', 'Anda tidak memiliki akses untuk ke halaman tersebut !!');

        return redirect()->back(); // Redirect back to the previous page
    }
}
