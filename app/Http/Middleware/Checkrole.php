<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan semua user yang sudah login untuk akses dashboard
        // (kontrol per-role bisa ditambahkan di sini sesuai kebutuhan)
        if (Auth::check()) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
