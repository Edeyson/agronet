<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisteredUser;
use App\Http\Requests\api\v1\LoginUserRequest;
use App\Http\Requests\api\v1\RegisterUserRequest;
use App\Http\Requests\api\v1\RegisterProducerRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\ProducerResource;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $email = $request->input('data.attributes.email');
        $password = $request->input('data.attributes.password');
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return response()->json([
                'token' => $request->user()
                ->createToken($request->input('data.attributes.nameToken'))
                ->plainTextToken,
                'message' => 'Successful authentication'
            ]);
        }
        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token revoked'
        ]);
    }

    public function register(RegisterUserRequest $request)
    {
        $user = RegisteredUser::create($request->input('data.attributes'));

        $token = $user->createToken($request->input('data.attributes.nameToken'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'Succesful Registration',
        ], 201);
    }

    public function getProfile(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    public function producerRegister(RegisterProducerRequest $request)
    {
        $user = $request->user();
        if(!$user->producer)
        {
            $user->producer()->create($request->input('data.attributes'));
        }

        $user->refresh();

        return new ProducerResource($user->producer);
    }

}
