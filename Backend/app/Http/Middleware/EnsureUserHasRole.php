<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Producer;
use App\Models\Role;
use App\Models\RegisteredUser;
use Closure;
use Illuminate\Http\Request;
use App\Models\PublicUser;

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
        $user = new PublicUser();
        $user->addRole($this->hasRole($request->user(), $role));        
        if (! $user->roleOf($role))
        {            
            return response()->json([
                'message' => 'Unauthorized'
                ], 401);
        }

        return $next($request);
    }

    public function hasRole($user, $type)
    {
        if($type == Role::ADMIN)
            return $user->admin;
        if($type == Role::PRODUCER)
            return $user->producer;
        if($type == Role::REGISTERED_USER)
            return $user;
    }
}
