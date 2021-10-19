<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_sucursales extends Model
{
    use HasFactory;
    protected $table = "proveedores_sucursales";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'domicilio',
                            'localidad',
                            'telefono',
                            'fax',
                            'correo_electronico',
                            ];
    protected $hidden = ['id_sucursal'];
}
