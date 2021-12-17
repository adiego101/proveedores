<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_telefono extends Model
{
    use HasFactory;
    protected $table = "proveedores_telefonos";
    protected $primaryKey = 'id_proveedor_telefono';

    protected $fillable = [
                            'nro_tel',
                            'id_proveedor',
                            'cod_area_tel',
                            'tipo_medio',
                            'desc_telefono',
                            'tipo_telefono',
                            'nro_orden_telefono'
                            ];

    //protected $hidden = ['id_proveedor_telefono'];

    public function obtenerProveedor_telefonos(){

        return Proveedor_telefono::All();
    }

    public function obtenerProveedor_telefonoId($id){

        return Proveedor_telefono::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor_telefono');
    }
}
