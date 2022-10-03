<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_banco extends Model
{
    use HasFactory;

    protected $table = "proveedores_bancos";
    protected $primaryKey = 'id_proveedor_banco';

    protected $fillable = [
                            'id_proveedor',
                            'id_banco',
                            'id_localidad',
                            'tipo_cuenta',
                            'nro_cuenta',
                            ];


    public function obtenerProveedoresBancos(){

        return Proveedor_banco::All();
    }

    public function obtenerProveedorBancoId($id){

        return Proveedor_banco::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
