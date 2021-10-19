<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presentaciones_estados extends Model
{
    use HasFactory;
    protected $table = "presentaciones_estados";

    protected $fillable = [
                            'cod_presentacion_estado',
                            'desc_presentacion_estado',
                            ];
                            
    protected $hidden = ['id_presentacion_estado'];
}
