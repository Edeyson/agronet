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
        $attributes = $request->data['attributes'];
        $request->replace($attributes);
        $cliente = new Cliente();
        $cliente->direccion = $request->direccion;
        $cliente->user_id = $user->id;
        $cliente->save();

        //dd($cliente->direccion);
        //$cliente = Cliente::create($request->validated());

        return new ClienteResource($cliente);

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
