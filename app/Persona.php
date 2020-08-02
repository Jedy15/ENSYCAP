<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'tblpersonal';

    protected $primaryKey = 'IdPersonal';

    public function scopeOperativo($query)
    {
        return $query
            ->leftJoin('t_mov_unidad', 'tblpersonal.IdPersonal', '=', 't_mov_unidad.IdPersonal')
            ->leftJoin('thorario', 'tblpersonal.IdPersonal', '=', 'thorario.IdPersonal')
            ->where('thorario.Estatus', 1)
            ->whereIn('t_mov_unidad.IdTipoMov', [1,2])
            ->where('t_mov_unidad.Status', 1)
            ->where('t_mov_unidad.Activo', 1)
            ->where('t_mov_unidad.CLUES', 'CSSSA005773');
    }
}
