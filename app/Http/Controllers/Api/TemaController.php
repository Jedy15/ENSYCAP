<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tema;
use Illuminate\Http\Request;

use App\Http\Resources\Tema as TemaResources;
use App\Http\Resources\TemaCollection;

use App\Http\Requests\Tema as TemaRequests;

class TemaController extends Controller
{
    protected $tema;

    public function __construct(Tema $tema)
    {
        $this->tema = $tema;
    }

    public function index()
    {
        return response()->json(
            new TemaCollection(
                $this->tema->orderBy('event_id', 'desc')->get()
            )
        );
    }


    public function store(TemaRequests $request)
    {
        $tema = $this->tema->create($request->all());
        return response()->json(new TemaResources($tema), 201);
    }


    public function show(Tema $tema)
    {
        return response()->json(new TemaResources($tema));
    }


    public function update(TemaRequests $request, Tema $tema)
    {
        $tema->update($request->all());
        return response()->json(new TemaResources($tema));
    }


    public function destroy(Tema $tema)
    {
        $tema->delete();
        return response()->json(null, 204);
    }
}
