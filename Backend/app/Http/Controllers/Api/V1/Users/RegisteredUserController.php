<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisteredUser;
use App\Http\Requests\api\v1\UserRequest;
use App\Http\Requests\api\v1\UserEditRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\UserResourceCollection;
use App\Http\Resources\Api\V1\AddrResourceCollection;
use App\Models\Addr;

class RegisteredUserController extends Controller
{    
    public function index(Request $request)
    {
        $users = RegisteredUser::simplePaginate(25);
        
        return new UserResourceCollection($users);
    }
    
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
    
    public function update(UserEditRequest $request, $id)
    {
        if($request->user()->admin)
        {            
            $user = RegisteredUser::find($id);
            if($user)
            {
                $upd = $user->update($request->input('data.attributes'));
                $user->refresh();
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
            $user = RegisteredUser::find($id);
            $upd = $user->update($request->input('data.attributes'));
            $user->refresh();
            return new UserResource($user);
        }

        return response()->json([
            'message' => 'Unauthorized'
            ], 401);       
             
    }
    
    public function destroy(Request $request, $id)
    {
        if($request->user()->admin)
        {            
            $user = RegisteredUser::find($id);
            if($user)
            {
                $user->delete();
                return response(null, 204);
            }
            return response()->json(['errors' => [
                'status' => 404,
                'title'  => 'Not Found'
                ]
            ], 404);  
            
        }

        if($request->user()->id == $id)
        {
            $request->user()->delete();
            return response(null, 204);
        }

        return response()->json([
            'message' => 'Unauthorized'
            ], 401); 
    }

    public function addrs(Request $request, $id)
    {
        if($request->user()->admin)
        {
            $addrs = Addr::where('registered_user_id', $id)->get();
            return new AddrResourceCollection($addrs);
        }
        if($request->user()->id == $id)
        {
            $addrs = Addr::where('registered_user_id', $id)->get();
            return new AddrResourceCollection($addrs);
        }

        return response()->json([
            'message' => 'Unauthorized'
            ], 401); 
        
    }
}
