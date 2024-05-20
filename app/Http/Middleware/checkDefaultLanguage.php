<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkDefaultLanguage
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
        $defaultCurrencyObj  = DB::table('acc_currencies')->where('company_id',session('company_id'))->where('is_default','=','1')->get();
       if($defaultCurrencyObj->count() == 0){

        return redirect()->route('acc_currency.index')->with('message', 'Please set the default currency');
       }
        return $next($request);
    }
}
