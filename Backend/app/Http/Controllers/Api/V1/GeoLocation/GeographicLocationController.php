<?php

namespace App\Http\Controllers\Api\V1\GeoLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\GeoLocationRequest;
use App\Models\GeoLocation;
use App\Models\Addr;
use App\Http\Resources\Api\V1\GeoLocationResource;
use App\Http\Resources\Api\V1\GeoLocationResourceCollection;


class GeographicLocationController extends Controller
{    
    public function index()
    {
        $geos = GeoLocation::simplePaginate(25);

        return new GeoLocationResourceCollection($geos);
    }
    
    public function store(GeoLocationRequest $request)
    {
        $user = $request->user();

        if($user->admin)
        {
            $addr = Addr::find($request->input('data.attributes'));
            
            $geo = GeoLocation::create($request->input('data.attributes'));
            return new GeoLocationResource($geo);           
        }  

        $addr = $user->addrs()->find($request->input('data.attributes.addr_id'));
        if($addr)
        {
            $geo = GeoLocation::create($request->input('data.attributes'));
            return new GeoLocationResource($geo);
        }

        return response()->json([
            'message' => 'Unauthorized'
            ], 401); 
        
    }
    
    public function show($id)
    {
        $geo = GeoLocation::find($id);

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
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
