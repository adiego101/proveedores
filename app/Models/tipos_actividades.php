<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipos_actividades extends Model
{
    use HasFactory;
    protected $table = "actividades_economicas_f883";

    protected $fillable = [
                            'cod_actividad_f833',
                            'desc_actividad_f883',
                            'descl_actividad_f883',
                            'agrupamiento',
                            'sector',
                            ];
    protected $hidden = ['id_actividades_economicas_f883'];
}
