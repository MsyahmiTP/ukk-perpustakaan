<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd($request);
        if (! $request->user() || ! in_array($request->user()->role,$roles)){
            abort(403, 'Tidak Di Perbolehkan Masuk.');
        }
        return $next($request);
    }
}
