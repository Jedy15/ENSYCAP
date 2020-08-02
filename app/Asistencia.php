<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'asistencia','acredita','constancia','libro','event_id','personal_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'personal_id', 'IdPersonal');
    }

    public $timestamps = false; //sin fechas de creación y actualización

    public function scopeRegistrados($query)
    {
        return $query
            ->leftJoin('tblpersonal', 'asistencias.personal_id', '=', 'tblpersonal.IdPersonal')
            ->leftJoin('thorario', 'asistencias.personal_id', '=', 'thorario.IdPersonal')
            ->leftJoin('tblturno', 'thorario.IdTurno', '=', 'tblturno.IdTurno')
            ->leftJoin('t_config_deptos', 'thorario.IdDepto', '=', 't_config_deptos.id_config_depto')
            ->leftJoin('tbldeptos', 't_config_deptos.tbldeptos_IdDepto', '=', 'tbldeptos.IdDepto')
            ->leftJoin('tlaboral', 'asistencias.personal_id', '=', 'tlaboral.IdPersonal')
            ->leftJoin('tbltabulador', 'tlaboral.Codigo', '=', 'tbltabulador.CODIGO')
            ->leftJoin('tblrama', 'tbltabulador.IdRama', '=', 'tblrama.IdRama')
            ->where('tlaboral.status', 1)
            ->where('thorario.Estatus', 1);
    }
}
