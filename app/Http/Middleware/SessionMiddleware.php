<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;
use Illuminate\Support\Facades\Cookie;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('valuta_marka')){
            if (Cookie::get('valuta_marka')){
                $to_currency = Cookie::get('valuta_marka');
                $valuta = Currency::find(1);
                session(['valuta_marka' => $to_currency]);
                session(['valuta_val' => $valuta->{$to_currency}]);
                $sinvol = $to_currency . '_sinvol';
                session(['valuta_sinvol' => $valuta->{$sinvol}]);
            }else{
                $to_currency = 'amd';
                $valuta = Currency::find(1);
                session(['valuta_marka' => $to_currency]);
                session(['valuta_val' => $valuta->{$to_currency}]);
                $sinvol = $to_currency . '_sinvol';
                session(['valuta_sinvol' => $valuta->{$sinvol}]);
            }
        }
        return $next($request);
    }
}
