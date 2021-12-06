<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_presentacion extends Model
{
    use HasFactory;

    protected $table = "proveedores_presentaciones";
    protected $primaryKey = 'id_proveedores_presentaciones';

    protected $fillable = [
                            'id_presentacion',
                            'id_proveedores_rupae',
                            'fecha_presentacion',
                            'ubic_presentacion',
                            'desc_proveedores_presentacion',
                            'id_presentacion_estado',
                            ];

    protected $hidden = ['id_proveedores_presentaciones'];

    public function obtenerProveedoresPresentaciones(){

        return Proveedor_presentacion::All();
    }

    public function obtenerProveedorPresentacionId($id){

        return Proveedor_presentacion::find($id);
    }
}
