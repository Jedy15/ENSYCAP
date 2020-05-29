<?php

namespace App\Http\Controllers\Api;

use App\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Curso as CursoResources;
use App\Http\Resources\CursoCollection;


use App\Http\Requests\Curso as CursoRequests;

class CursoController extends Controller
{
    protected $curso;

    public function __construct(Curso $curso)
    {
        $this->curso = $curso;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            new CursoCollection(
                $this->curso->orderBy('id', 'desc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequests $request)
    {
        $curso = $this->curso->create($request->all());
        return response()->json(new CursoResources($curso), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return response()->json(new CursoResources($curso));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(CursoRequests $request, Curso $curso)
    {
        $curso->update($request->all());

        return response()->json(new CursoResources($curso));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return response()->json(null, 204);
    }
}
