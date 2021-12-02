<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_actividad extends Model
{
    use HasFactory;

    protected $table = "tipos_actividades";

    protected $fillable = [
                            'desc_tipo_actividad',
                            ];
                            
    protected $hidden = ['id_tipo_actividad'];

    public function obtenerTiposActividades(){

        return Tipo_actividad::All();
    }

    public function obtenerTipoActividadId($id){

        return Tipo_actividad::find($id);
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'actividades_proveedores', 'id_tipo_actividad', 'id_proveedor');
    }

    public function actividades_economicas(){
        return $this->belongsToMany(Actividad_economica::class, 'actividades_proveedores', 'id_tipo_actividad', 'id_actividad_economica');
    }
}
