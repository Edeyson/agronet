<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\api\v1\RegisterUserRequest;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $attributes = $request->data['attributes'];
        //$request->replace($attributes);
        $user = User::create($attributes->validated());

        $token = $user->createToken($request->nameToken)->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'Succesful Registration',
        ], 201);
    }
}
