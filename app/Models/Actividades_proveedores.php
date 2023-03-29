<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades_proveedores extends Model
{
    use HasFactory;

    protected $table = "actividades_proveedores";

    protected $fillable = [
                            'id_proveedor',
                            'id_actividad_economica',
                            'id_tipo_actividad',
                            'ap_start_date',
                            'ap_end_date',
                            'id_disposicion',
                            'estado_cod'
                            ];

    //protected $hidden = ['id_actividad_proveedor'];
    protected $primaryKey = 'id_actividad_proveedor';

    public function obtenerActividades_proveedores(){

        return Actividades_proveedores::All();
    }

    public function obtenerActividades_proveedoresId($id){

        return Actividades_proveedores::find($id);
    }


}
