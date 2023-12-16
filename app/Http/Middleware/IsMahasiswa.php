<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role != 'mahasiswa') {
            abort(403);
            // return response()->view('errors.index', [
            //     'title' => 'Akses ditolak',
            //     'message' => 'Anda dilarang mengakses halaman ini',
            //     'code' => '403',
            // ], 403);
        }
        return $next($request);
    }
}
