<?php

namespace App\Http\Controllers\Api\V1\Geo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\RegisterAddrRequest;
use App\Models\Addr;
use App\Http\Resources\Api\V1\AddrResource;
use App\Http\Resources\Api\V1\AddrResourceCollection;

class AddrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $addrs = $user->addrs;

        return new AddrResourceCollection($addrs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterAddrRequest $request)
    {
        $user = $request->user();

        $addr = $user->addrs()->create($request->input('data.attributes'));

        $user->refresh();

        //dd($addr);

        return new AddrResource($addr);
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
