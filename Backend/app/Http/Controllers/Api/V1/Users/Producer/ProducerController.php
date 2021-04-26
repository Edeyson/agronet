<?php

namespace App\Http\Controllers\Api\V1\Users\Producer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\ProducerRequest;
use App\Http\Resources\Api\V1\ProducerResource;

class ProducerController extends Controller
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
     * RegUser to Producer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProducerRequest $request)
    {
        $user = $request->user();
        if(!$user->producer)
        {
            $user->producer()->create($request->input('data.attributes'));
        }
        else
        {
            return response()->json(['errors' => [
                'status' => 409,
                'title'  => 'duplicate resource'
                ]
            ], 409);
        }

        $user->refresh();

        return new ProducerResource($user->producer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Perfil Producer Logged
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
