<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
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

        $permissions = array_except(func_get_args(), [0,1]);
        if ($request->user()->hasAnyPermission($permissions) || !$permissions) 
        {
            return $next($request);
        }
        return response("Insufficient permissions", 401);
    }
}
