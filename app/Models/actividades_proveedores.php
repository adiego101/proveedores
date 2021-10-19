<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividades_proveedores extends Model
{
    use HasFactory;
    protected $table = "actividades_proveedores";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'tipo_de_actividad',
                            'actividad',
                            ];
                            
    protected $hidden = ['id_actividad_proveedor'];
}
