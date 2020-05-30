<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modalidad;
use Illuminate\Http\Request;

use App\Http\Resources\Modalidad as ModalidadResources;
use App\Http\Resources\ModalidadCollection;


use App\Http\Requests\Modalidad as ModalidadRequests;

class ModalidadController extends Controller
{
    protected $modalidad;

    public function __construct(Modalidad $modalidad)
    {
        $this->modalidad = $modalidad;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            new ModalidadCollection(
                $this->modalidad->orderBy('id', 'desc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modalidad = $this->modalidad->create($request->all());
        return response()->json(new ModalidadResources($modalidad), 201);        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function show(Modalidad $modalidad)
    {
        return response()->json(new ModalidadResources($modalidad));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function update(ModalidadRequests $request, Modalidad $modalidad)
    {
        $modalidad->update($request->all());

        return response()->json(new ModalidadResources($modalidad));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modalidad $modalidad)
    {
        $modalidad->delete();
        return response()->json(null, 204);
    }
}
