<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad_proveedor extends Model
{
    use HasFactory;

    protected $table = "actividades_proveedores";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'tipo_de_actividad',
                            'actividad',
                            ];
                            
    protected $hidden = ['id_actividad_proveedor'];

    public function obtenerActividadesProveedores(){

        return Actividad_proveedor::All();
    }

    public function obtenerActividadProveedorId($id){

        return Actividad_proveedor::find($id);
    }
}
