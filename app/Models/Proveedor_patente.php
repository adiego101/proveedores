<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_patente extends Model
{
    use HasFactory;

    protected $table = "proveedores_patentes";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'dominio',
                            'marca',
                            'modelo',
                            'inscripto_en',
                            ];

    protected $hidden = ['id_proveedores_patentes'];

    public function obtenerProveedoresPatentes(){

        return Proveedor_patente::All();
    }

    public function obtenerProveedorPatenteId($id){

        return Proveedor_patente::find($id);
    }
}
