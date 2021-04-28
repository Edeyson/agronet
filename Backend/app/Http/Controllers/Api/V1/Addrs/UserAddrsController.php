<?php

namespace App\Http\Controllers\Api\V1\Users\Addrs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\AddrResource;
use App\Http\Resources\Api\V1\AddrResourceCollection;

class UserAddrsController extends Controller
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
    public function store(Request $request)
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
    public function show(Request $request, $id)
    {
        //$addr = Addr::find($id);

        $addr = $request->user()->addrs()->find($id);

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
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $addr = $request->user()->addrs()->find($id);
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
        $user = $request->user();
        $addr = $request->user()->addrs()->find($id);
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
