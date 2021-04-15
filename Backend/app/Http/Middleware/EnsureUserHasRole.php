<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Cliente;
use App\Models\Gestor;
use App\Models\Productor;
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
        $user->addRoles($this->getRoles($request->user()));
        if (! $user->roleOf($role))
        {
            return response()->json([
                'message' => 'Unauthorized'
                ], 401);
        }

        return $next($request);
    }

    private function getClientRole($user)
    {
        return Cliente::find($user->id);
    }

    private function getAdminRole($user)
    {
        return Admin::find($user->id);
    }

    private function getGestorRole($user)
    {
        return Gestor::find($user->id);
    }

    private function getProductorRole($user)
    {
        return Productor::find($user->id);
    }

    private function getRoles($user)
    {
        $roles = array();
        $this->getClientRole($user) ? array_push($roles, $this->getClientRole($user)) : '';
        $this->getAdminRole($user) ? array_push($roles, $this->getAdminRole($user)) : '';
        $this->getGestorRole($user) ? array_push($roles, $this->getGestorRole($user)) : '';
        $this->getProductorRole($user) ? array_push($roles, $this->getProductorRole($user)) : '';
        return $roles;
    }
}
