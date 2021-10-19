<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_presentaciones extends Model
{
    use HasFactory;
    protected $table = "proveedores_presentaciones";

    protected $fillable = [
                            'id_presentacion',
                            'id_proveedores_rupae',
                            'fecha_presentacion',
                            'ubic_presentacion',
                            'desc_proveedores_presentacion',
                            'id_presentacion_estado',
                            ];

    protected $hidden = ['id_proveedores_presentaciones'];
}
