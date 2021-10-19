<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clasificaciones_empresas extends Model
{
    use HasFactory;
    protected $table = "clasificaciones_empresas";

    protected $fillable = [
                            'tamanio',
                            'sector',
                            'simbolo',
                            'facturacion_max',
                            'fact_max_2018',
                            ];
                            
    protected $hidden = ['id_clasificacion_empresa'];
}
