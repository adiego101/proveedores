<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_domicilios extends Model
{
    use HasFactory;
    protected $table = "proveedores_domicilios";

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
                            ];
    protected $hidden = ['id_proveedores_domicilios'];
}
