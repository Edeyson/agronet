<?php

namespace App\Http\Controllers\Api\V1\Addrs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\AddrRequest;
use App\Models\Addr;
use App\Http\Resources\Api\V1\AddrResource;
use App\Http\Resources\Api\V1\AddrResourceCollection;
use App\Http\Resources\Api\V1\GeoLocationResource;
use App\Models\RegisteredUser;
use App\Models\GeoLocation;

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
            $addr = Addr::create($request->input('data.attributes'));
            return new AddrResource($addr);
        }            

        if($user->id == $request->input('data.attributes.registered_user_id'))
        {
            $addr = Addr::create($request->input('data.attributes'));
            return new AddrResource($addr);
        }       

        return response()->json([
            'message' => 'Unauthorized'
            ], 401);         
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

        if(isset($addr))
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
        if(isset($addr))
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

    public function geoLocation(Request $request, $id)
    {
        if($request->user()->admin)
        {
            $geo = GeoLocation::where('addr_id', $id)->first();
            //dd($geo);
            if($geo)
            {
                return new GeoLocationResource($geo);
            }
            return response()->json(['errors' => [
                'status' => 404,
                'title'  => 'Not Found'
                ]
            ], 404);            
            
        }
        
        $addr = $request->user()->addrs()->find($id);
        if($addr)
            $geo = $addr->geoLocation;       

        if(isset($geo))
        {
            return new GeoLocationResource($geo);
        }
        else
        {
            return response()->json(['errors' => [
                'status' => 404,
                'title'  => 'Not Found'
                ]
            ], 404);      
        }
        
    }
}
