<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class returnToPos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('user_id')){
            return response()->json('returnToPos');

        }
        else{
            return $next($request);

        }

    }
}
