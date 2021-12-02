<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_domicilio extends Model
{
    use HasFactory;

    protected $table = "proveedores_domicilio";

    protected $fillable = [
                            'tipo_domicilio',
                            'nro_orden_domicilio',
                            'calle',
                            'numero',
                            'lote',
                            'entre_calles',
                            'monoblock',
                            'dpto',
                            'puerta',
                            'oficina',
                            'manzana',
                            'barrio',
                            'codigo_postal',
                            ];

    protected $hidden = ['id_proveedor_domicilio'];
    protected $primaryKey = 'id_proveedor_domicilio';

    public function obtenerDomicilio_proveedors(){

        return Proveedor_domicilio::All();
    }

    public function obtenerDomicilio_proveedorId($id){

        return Proveedor_domicilio::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_domicilio_proveedor', 'id_proveedor');
    }

    public function localidad(){
        return $this->belongsTo(Localidad::class, 'id_localidad', 'id_localidad');
    }
}
