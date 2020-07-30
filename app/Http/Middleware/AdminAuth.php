<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    //Handle the incoming request, check if the current user is logged in and is a admin
    public function handle($request, Closure $next) {
        //Check if a user is authenticated
        if(Auth::check() == true && Auth::user()->is_admin)
            return $next($request);
        else
            abort(403, 'Unauthorized action. Please log-in first.');
        return null;
    }

}
