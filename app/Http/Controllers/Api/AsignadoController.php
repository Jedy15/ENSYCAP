<?php

namespace App\Http\Controllers\Api;

use App\Asignado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Asignado as AsignadoResources;
use App\Http\Resources\AsignadoCollection;

use App\Http\Requests\Asignado as AsignadoRequests;

class AsignadoController extends Controller
{
    protected $asignado;

    public function __construct(Asignado $asignado)
    {
        $this->asignado = $asignado;
    }

    public function index()
    {
        return response()->json(
            new AsignadoCollection(
                $this->asignado->orderBy('id', 'desc')->get()
            )
        );
    }

    public function store(AsignadoRequests $request)
    {
        $asignado = $this->asignado->create($request->all());
        return response()->json(new AsignadoResources($asignado), 201);        
    }

    public function show(Asignado $asignado)
    {
        return response()->json(new AsignadoResources($asignado));   
    }

    public function update(AsignadoRequests $request, Asignado $asignado)
    {
        $asignado->update($request->all());
        return response()->json(new AsignadoRequests($asignado));        
    }

    public function destroy(Asignado $asignado)
    {
        $asignado->delete();
        return response()->json(null, 204);        
    }
}
