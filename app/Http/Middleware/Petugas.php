<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Petugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'petugas') {
            return $next($request); // lanjut ke handler berikutnya
        }
        
        abort(403, 'Anda tidak memiliki hak akses untuk melakukan tindakan ini.');
    }
}
