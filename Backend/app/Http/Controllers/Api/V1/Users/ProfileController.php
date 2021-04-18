<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        //$user = User::find($id);
        $user = $request->user();
        return new UserResource($user);
    }
}
