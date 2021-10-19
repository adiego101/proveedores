<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipos_actividades extends Model
{
    use HasFactory;
    protected $table = "tipos_actividades";

    protected $fillable = [
                            'tipo_actividad',
                            ];
                            
    protected $hidden = ['id_tipo_actividad'];
}
