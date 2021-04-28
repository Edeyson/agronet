<?php

namespace App\Http\Controllers\Api\V1\Addrs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\AddrRequest;
use App\Models\Addr;
use App\Http\Resources\Api\V1\AddrResource;
use App\Http\Resources\Api\V1\AddrResourceCollection;
use App\Models\RegisteredUser;

class AddrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request Query Parameters
       $addrs = Addr::simplePaginate(25);

       return new AddrResourceCollection($addrs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddrRequest $request)
    {
        $user = $request->user();

        if($user->admin)
        {
            //dd($userAdr->admin);
            $user = RegisteredUser::find($request->input('data.attributes.id'));

            if($user)
            {
                $addr = $user->addrs()->create($request->input('data.attributes'));

                $user->refresh();

                return new AddrResource($addr);
            }   

            return response()->json(['errors' => [
                'status' => 404,
                'title'  => 'Not Found',
                'errors'  => 'User id is required'
                ]
            ], 404);         
        }

        if($request->input('data.attributes.id'))
        {
            if($request->user()->id == $request->input('data.attributes.id'))
            {
                $addr = $user->addrs()->create($request->input('data.attributes'));

                $user->refresh();

                return new AddrResource($addr);
            }
        }

        return response()->json([
            'message' => 'Unauthorized'
            ], 401);        

        //dd($addr);
        
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
            $addr = Addr::find($id);
        }
        else
        {
            $addr = $request->user()->addrs()->find($id);
        }        

        if($addr)
        {
            return new AddrResource($addr);
        }        

        return response()->json(['errors' => [
            'status' => 404,
            'title'  => 'Not Found'
            ]
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddrRequest $request, $id)
    {
        if($request->user()->admin)
        {
            $addr = Addr::find($id);
        }
        else
        {
            $user = $request->user();
            $addr = $request->user()->addrs()->find($id);
        }        
        if($addr)
        {
            $addr->update($request->input('data.attributes'));
            return new AddrResource($addr);
        }

        return response()->json(['errors' => [
            'status' => 404,
            'title'  => 'Not Found'
            ]
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->user()->admin)
        {
            $addr = Addr::find($id);
        }
        else
        {
            $user = $request->user();
            $addr = $request->user()->addrs()->find($id);
        }        
        if($addr)
        {
            $addr->delete();
            return response(null, 204);
        }

        return response()->json(['errors' => [
            'status' => 404,
            'title'  => 'Not Found'
            ]
        ], 404);
    }
}
