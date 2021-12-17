<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_patente extends Model
{
    use HasFactory;

    protected $table = "proveedores_patentes";
    protected $primaryKey = 'id_proveedores_patentes';

    protected $fillable = [
                            'dominio',
                            'marca',
                            'id_proveedor',
                            'modelo',
                            'inscripto_en',
                            ];

    //protected $hidden = ['id_proveedor_patente'];

    public function obtenerProveedoresPatentes(){

        return Proveedor_patente::All();
    }

    public function obtenerProveedorPatenteId($id){

        return Proveedor_patente::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
