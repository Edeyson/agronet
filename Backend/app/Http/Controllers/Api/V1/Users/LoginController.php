<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\api\v1\LoginUserRequest;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            return response()->json([
                'token' => $request->user()
                ->createToken($request->nameToken)
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
}
