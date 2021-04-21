<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\RegisteredUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\ProducerResource;
use App\Http\Requests\api\v1\RegisterProducerRequest;

class ProducerController extends Controller
{
    public function register(RegisterProducerRequest $request)
    {
        $user = $request->user();
        if(!$user->producer)
            $user->producer()->create($request->input('data.attributes'));

        return new ProducerResource($user->producer);
    }

    public function prueba(Request $request)
    {
        return "Producer OK";
    }

    public function show(Request $request)
    {
        //$user = User::find($id);
        //$user = $request->user();
        //return new UserResource($user);
    }
}
