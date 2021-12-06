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
                            'poliza',
                            'agencia',
                            'asegurado',
                            'vigencia_hasta',
                            ];

    protected $hidden = ['id_proveedor_seguro'];
    protected $primaryKey = 'id_proveedor_seguro';

    public function obtenerProveedoresSeguros(){

        return Proveedor_seguro::All();
    }

    public function obtenerProveedorSeguroId($id){

        return Proveedor_seguro::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
