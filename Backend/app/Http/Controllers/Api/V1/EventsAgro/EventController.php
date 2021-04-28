<?php

namespace App\Http\Controllers\Api\V1\Geo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\v1\RegisterEventRequest;
use App\Http\Resources\Api\V1\EventResource;
use App\Http\Resources\Api\V1\EventResourceCollection;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Example Comming Events : http://localhost:8000/api/events?date=2019-12-31

        $events = Event::simplePaginate(25);

        if($request->get('date'))
        {
            //$date = date($request->get('date'));
            //dd($date);
            $query = $events->where('fecha', '>=', $request->get('date'));
            return new EventResourceCollection($query);
        }
        else
        {
            return new EventResourceCollection($events);
        }


        //$events = Event::simplePaginate(25);

        //return new EventResourceCollection($events);


        /* Eventos del productor logueado
        $producer = $request->user()->producer;

        $events = $producer->events;

        return new EventResourceCollection($events);
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterEventRequest $request)
    {
        $producer = $request->user()->producer;

        $event = $producer->events()->create($request->input('data.attributes'));

        $producer->refresh();

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
