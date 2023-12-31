<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)    {
        if (!session()->has('LoggedInUser') && ($request->path() != '/auth/login' && $request->path() != '/auth/register')) {
            return redirect(route('login'));
        }

        if (session()->has('LoggedInUser') && ($request->path() == '/auth/login' || $request->path() == '/auth/register')) {
            return redirect(route('login'));
        }
        return $next($request)
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1992 00:00:00 GMT');
    }
}
