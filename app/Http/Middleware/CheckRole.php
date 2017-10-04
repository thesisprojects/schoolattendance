<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
       
        if ($request->user() === null) 
        {
            return response("Insufficient permissions", 401);
        }

        $roles = array_except(func_get_args(), [0,1]);
        
        if ($request->user()->hasAnyRole($roles) || !$roles) 
        {
            return $next($request);
        }
        return response("Insufficient permissions", 401);
        
    }
}
