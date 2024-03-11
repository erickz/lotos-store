<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class CheckStore
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
        // Extract the subdomain from URL.
        $arHost = explode('.', $request->getHost(), 2);

        $subdomain = $arHost[0];

        // Retrieve requested tenant's info from database. If not found, abort the request.
        $store = Store::where('alias', $subdomain)->first();

        if (! $store){
            abort(403, 'Access Denied');
        }

        // Store the store info into session.
        $request->session()->put('storeData', $store);

        if (Auth::check()){
            if (Auth::user()->store_id != 1){
                //Force logout if the user is accessing from an unauthorized path
                if (Auth::user()->store_id != $store->id){
                    Auth::logout();
                }
            }
        }

        return $next($request);
    }
}
