<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionPackageOne
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
        $users= DB::table('users')->where('company_id',session()->get('company_id'))->get();
        $user_count= count($users);
        if($user_count==5){
            return redirect('companySubscription')->with('status','please upgrade Your Subscription to add users');
            // return back();

        }
        else{

            return $next($request);
        }

    }
}
