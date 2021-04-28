<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\api\v1\LoginUserRequest;

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
            ],200);
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


}
