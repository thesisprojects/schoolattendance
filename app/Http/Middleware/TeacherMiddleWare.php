<?php

namespace App\Http\Middleware;

use Closure;

class TeacherMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return response("System error account not detected.", 401);
        }

        if ($request->user()->isTeacher) {
            return $next($request);
        }

        return response("Your account needs to be marked as teacher in order to use the attendance system.", 401);
    }
}
