<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Ponente;
use Illuminate\Http\Request;

use App\Http\Requests\Ponente as PonenteRequests;

use App\Http\Resources\Ponente as PonenteResources;
use App\Http\Resources\PonenteCollection;



class PonenteController extends Controller
{
    protected $ponente;

    public function __construct(Ponente $ponente)
    {
        $this->ponente = $ponente;
    }

    public function index()
    {
        return response()->json(
            new PonenteCollection(
                $this->ponente->orderBy('id', 'desc')->get()
            )
        );
    }


    public function store(PonenteRequests $request)
    {
        $ponente = $this->ponente->create($request->all());
        return response()->json(new PonenteResources($ponente), 201);
    }


    public function show(Ponente $ponente)
    {
        return response()->json(new PonenteResources($ponente));
    }


    public function update(PonenteRequests $request, Ponente $ponente)
    {
        $ponente->update($request->all());

        return response()->json(new PonenteResources($ponente));
    }


    public function destroy(Ponente $ponente)
    {
        $ponente->delete();
        return response()->json(null, 204);
    }
}
