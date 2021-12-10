<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = "pagos";
    protected $primaryKey = 'id_pagos';


    protected $fillable = [
                            'fecha',
                            'id_proveedor',
                            'importe',
                            'observaciones',
                            ];

    protected $hidden = ['id_pagos'];

    public function obtenerPagos(){

        return Pago::All();
    }

    public function obtenerPagoId($id){

        return Pago::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
