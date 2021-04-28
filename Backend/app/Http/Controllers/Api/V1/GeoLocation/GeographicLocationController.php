<?php

namespace App\Http\Controllers\Api\V1\GeoLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\RegisterGeoLocationRequest;
use App\Models\GeoLocation;
use App\Http\Resources\Api\V1\GeoLocationResource;

class GeographicLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterGeoLocationRequest $request)
    {
        // TODO User get Direccion -> addr_id -> create geoLocation
        //  (No permitir crear una coordenada a una direccion que no me pertenece)
        $user = $request->user();

        //dd($user->addrs()->where('id', '=', $request->input('data.attributes.addr_id'))->first());

        $addr = $user->addrs()->where('id', '=', $request->input('data.attributes.addr_id'))->first();

        $geo = $addr->geoLocation()->create($request->input('data.attributes'));

        $addr->refresh();

        return new GeoLocationResource($geo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
