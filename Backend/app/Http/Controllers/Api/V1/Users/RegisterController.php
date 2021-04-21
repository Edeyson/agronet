<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\RegisteredUser;
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
        $user = RegisteredUser::create($request->input('data.attributes'));

        $token = $user->createToken($request->input('data.attributes.nameToken'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'Succesful Registration',
        ], 201);
    }
}
