<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisteredUser;
use App\Http\Requests\api\v1\UserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\UserResourceCollection;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = RegisteredUser::simplePaginate(25);
        
        return new UserResourceCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = RegisteredUser::create($request->input('data.attributes'));

        return new UserResource($user);

        /*$token = $user->createToken($request->input('data.attributes.nameToken'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'Succesful Registration',
        ], 201);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->user()->admin)
        {
            $user = RegisteredUser::find($id);

            if($user)
            {
                return new UserResource($user);
            }

            return response()->json(['errors' => [
                'status' => 404,
                'title'  => 'Not Found'
                ]
            ], 404);            
            
        }

        if($request->user()->id == $id)
        {
            return new UserResource($request->user());
        }
        
        return response()->json([
                'message' => 'Unauthorized'
                ], 401);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
