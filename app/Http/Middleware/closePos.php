<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class closePos
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
        // cashRegisterId

        if(session()->has('cashRegisterId')){
        $cashRegister =  DB::table('sal_cash_registers')->where('company_id',session('company_id'))->where('id',session('cashRegisterId'))->get()->first();

        if($cashRegister->status == 'close'){
            session()->forget(['cashRegisterId','invoice','posOpenRegisterAmount']);
            session()->save();
            return back();

        }
        else{
            return $next($request);

        }
    }
    else{
        return $next($request);

    }

        
    }
}
