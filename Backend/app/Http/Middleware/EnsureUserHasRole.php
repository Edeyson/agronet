<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserBasic;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = new UserBasic();
        $user->addRole($request->user());
        if (! $user->roleOf($role)) 
        {
            return response()->json([
                'message' => 'Unauthorized'
                ], 401);      
        }

        return $next($request);
    }
}
