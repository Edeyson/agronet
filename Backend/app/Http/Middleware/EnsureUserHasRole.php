<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Cliente;
use App\Models\Gestor;
use App\Models\Productor;
use App\Models\Role;
use App\Models\User;
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
        if($type == Role::PRODUCTOR)
            return $user->productor;
        if($type == Role::GESTOR)
            return $user->gestor;
        if($type == Role::CLIENTE)
            return $user->cliente;
    }
}
