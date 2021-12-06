<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_actividad extends Model
{
    use HasFactory;

    protected $table = "tipos_actividades";
    protected $primaryKey = 'id_tipo_actividad';

    protected $fillable = [
                            'tipo_actividad',
                            ];

    protected $hidden = ['id_tipo_actividad'];

    public function obtenerTiposActividades(){

        return Tipo_actividad::All();
    }

    public function obtenerTipoActividadId($id){

        return Tipo_actividad::find($id);
    }
}
