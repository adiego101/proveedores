<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_seguro extends Model
{
    use HasFactory;

    protected $table = "proveedores_seguros";
    protected $primaryKey = 'id_proveedores_seguros';

    protected $fillable = [
                            'id_proveedores_rupae',
                            'poliza',
                            'agencia',
                            'asegurado',
                            'vigencia_hasta',
                            ];

    protected $hidden = ['id_proveedores_seguros'];

    public function obtenerProveedoresSeguros(){

        return Proveedor_seguro::All();
    }

    public function obtenerProveedorSeguroId($id){

        return Proveedor_seguro::find($id);
    }
}
