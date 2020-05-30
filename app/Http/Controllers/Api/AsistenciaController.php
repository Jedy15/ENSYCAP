<?php

namespace App\Http\Controllers\Api;

use App\Asistencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Asistencia as AsistenciaResources;
use App\Http\Resources\AsistenciaCollection;

use App\Http\Requests\Asistencia as AsistenciaRequests;

class AsistenciaController extends Controller
{
    protected $asistencia;

    public function __construct(Asistencia $asistencia)
    {
        $this->asistencia = $asistencia;
    }

    public function index()
    {
        return response()->json(
            new AsistenciaCollection(
                $this->asistencia->orderBy('id', 'desc')->get()
            )
        );   
    }

    public function store(AsistenciaRequests $request)
    {
        $asistencia = $this->asistencia->create($request->all());
        return response()->json(new AsistenciaResources($asistencia), 201);        
    }

    public function show(Asistencia $asistencia)
    {
        return response()->json(new AsistenciaResources($asistencia));
        
    }

    public function update(AsistenciaRequests $request, Asistencia $asistencia)
    {
        $asistencia->update($request->all());
        return response()->json(new AsistenciaResources($asistencia));        
    }

    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();
        return response()->json(null, 204);
    }
}
