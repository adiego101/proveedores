<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_telefono extends Model
{
    use HasFactory;
    protected $table = "proveedores_telefonos";
    protected $primaryKey = 'id_proveedores_telefonos';

    protected $fillable = [
                            'id_proveedores_rupae',
                            'tipo_telefono',
                            'nro_orden_telefono',
                            'nro_tel',
                            'tipo_medio',
                            ];

    protected $hidden = ['id_proveedores_telefonos'];

    public function obtenerProveedoresTelefonos(){

        return Proveedor_telefono::All();
    }

    public function obtenerProveedorTelefonoId($id){

        return Proveedor_telefono::find($id);
    }
}
