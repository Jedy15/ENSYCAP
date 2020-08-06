<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    protected $persona;

    public function __construct(Persona $persona)
    {
        $this->persona = $persona;
    }

    public function index(Request $request)
    {
        $persona = $this->persona
            ->select('tblpersonal.IdPersonal as id',$this->persona->raw('concat(thorario.NTarjeta, " ", tblpersonal.NOMBRES, " ", tblpersonal.APELLIDOS) as text'))
            ->operativo()
            ->whereRaw('CONCAT(thorario.NTarjeta, " ", tblpersonal.NOMBRES, " ", tblpersonal.APELLIDOS) like "%'.$request->term.'%"')
            ->orderBy('NTarjeta','asc')
            ->paginate(10);
        return response()->json($persona);
    }

    public function tabla()
    {       
        $persona = $this->persona
            ->select('tblpersonal.IdPersonal', 'tblpersonal.NOMBRES', 'tblpersonal.APELLIDOS', 'thorario.NTarjeta', 'DEPARTAMENTO', 'Turno', 'NombreRama', 
            'PUESTO', 'Telefono', 'Correo')
            ->operativo()
            ->orderBy('NTarjeta','asc')
            ->get();
        return response()->json($persona);
    }
}
