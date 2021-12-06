<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_sucursal extends Model
{
    use HasFactory;

    protected $table = "proveedores_sucursales";
    protected $primaryKey = 'id_sucursal';

    protected $fillable = [
                            'id_proveedores_rupae',
                            'domicilio',
                            'localidad',
                            'telefono',
                            'fax',
                            'correo_electronico',
                            ];

    protected $hidden = ['id_sucursal'];

    public function obtenerProveedoresSucursales(){

        return Proveedor_sucursal::All();
    }

    public function obtenerProveedorSucursalId($id){

        return Proveedor_sucursal::find($id);
    }
}
