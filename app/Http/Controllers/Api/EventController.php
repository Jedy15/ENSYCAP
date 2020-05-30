<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Event as EventResources;
use App\Http\Resources\EventCollection;

use App\Http\Requests\Event as EventRequests;

class EventController extends Controller
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        return response()->json(
            new EventCollection(
                $this->event->orderBy('id', 'desc')->get()
            )
        );

    }


    public function store(EventRequests $request)
    {
        $event = $this->event->create($request->all());
        return response()->json(new EventResources($event), 201);
    }


    public function show(Event $event)
    {
        return response()->json(new EventResources($event));
    }


    public function update(EventRequests $request, Event $event)
    {
        $event->update($request->all());
        return response()->json(new EventResources($event));
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }
}
