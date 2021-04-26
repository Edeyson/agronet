<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RegisteredUser;
use App\Http\Requests\api\v1\LoginUserRequest;
use App\Http\Requests\api\v1\UserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\ProducerResource;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    public function producer(Request $request)
    {
        $producer = $request->user()->producer;

        return new ProducerResource($producer);
    }

    public function admin(Request $request)
    {
        $admin = $request->user()->admin;

        return new AdminResource($admin);
    }

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
