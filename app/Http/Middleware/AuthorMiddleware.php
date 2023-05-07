<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            if(Auth::user()->role_as == '2')
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('status', 'Access Denied! Must be an Author');
            }
        }
        else
        {
            return redirect('/login')->with('message', 'Please Login');
        }
    }
}
