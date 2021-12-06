<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_domicilio extends Model
{
    use HasFactory;

    protected $table = "proveedores_domicilios";
    protected $primaryKey = 'id_proveedores_domicilios';

    protected $fillable = [
                            'id_proveedores_rupae',
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
                            'id_localidad',
                            'email',
                            'fax',
                            'telefono',
                            ];


    protected $hidden = ['id_proveedores_domicilios'];

    public function obtenerProveedoresDomicilios(){

        return Proveedor_domicilio::All();
    }

    public function obtenerProveedorDomicilioId($id){

        return Proveedor_domicilio::find($id);
    }
}
