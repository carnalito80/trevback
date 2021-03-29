<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
{
    /**
     * Check if users role_id is 0 or 1.. 
     */
    public function handle($request, Closure $next)
    { 
        if ( Auth::user()) {
            if ( Auth::user()->role_id == 1 || Auth::user()->role_id == 0 ) {
               return $next($request);
              
            }
            else return response()->json(['error' => 'Unauthorized ;('], 401);
        }
        else return response()->json(['error' => 'Not Logged In'], 401);

       
    }
}