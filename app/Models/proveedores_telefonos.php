<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_telefonos extends Model
{
    use HasFactory;
    protected $table = "proveedores_telefonos";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'tipo_telefono',
                            'nro_orden_telefono',
                            'nro_tel',
                            'tipo_medio',
                            ];
                            
    protected $hidden = ['id_proveedores_telefonos'];
}
