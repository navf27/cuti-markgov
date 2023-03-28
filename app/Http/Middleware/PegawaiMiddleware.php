<?php

namespace App\Http\Middleware;

use App\Models\User;
// use App\Models\Pegawai;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiMiddleware
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
        if(Auth::user()->role != User::PEGAWAI){
            alert()->error('Error',"You don't have pegawai access!");
            return back();
        }
        return $next($request);
    }
}
