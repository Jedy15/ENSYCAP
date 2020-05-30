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


    public function index()
    {
        return response()->json(
            new CursoCollection(
                $this->curso->orderBy('id', 'desc')->get()
            )
        );
    }


    public function store(CursoRequests $request)
    {
        $curso = $this->curso->create($request->all());
        return response()->json(new CursoResources($curso), 201);
    }


    public function show(Curso $curso)
    {
        return response()->json(new CursoResources($curso));
    }


    public function update(CursoRequests $request, Curso $curso)
    {
        $curso->update($request->all());
        return response()->json(new CursoResources($curso));
    }


    public function destroy(Curso $curso)
    {
        $curso->delete();
        return response()->json(null, 204);
    }
}
