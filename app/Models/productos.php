<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    protected $table = "productos";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'producto_elaborado',
                            'rnpa',
                            'producida_unidad',
                            'capacidad_produccion_total',
                            ];
    protected $hidden = ['id_producto'];
}
