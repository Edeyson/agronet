<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\RegisterClientRequest;
use App\Http\Resources\Api\V1\ClienteResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function register(RegisterClientRequest $request)
    {
        $user = $request->user();
        $user->cliente()->create($request->input('data.attributes'));

        return new ClienteResource($user->cliente);
    }

    public function prueba(Request $request)
    {
        return "Si es Cliente";
    }

    public function show(Request $request)
    {
        //$user = User::find($id);
        //$user = $request->user();
        //return new UserResource($user);
    }
}
