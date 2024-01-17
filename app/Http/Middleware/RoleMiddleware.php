<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if(auth()->user() && auth()->user()->role->name === $role)
        {
            return $next($request);
        } else if(auth()->user()){
            return redirect()->route('error');
        } else {
            return $next($request);
        }
    }

}


