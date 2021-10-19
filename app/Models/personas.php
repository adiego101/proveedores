<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personas extends Model
{
    use HasFactory;
    protected $table = "personas";

    protected $fillable = [
                            'dni_persona',
                            'cuil_persona',
                            'nombre_persona',
                            'apellido_persona',
                            'genero_persona',
                            ];

    protected $hidden = ['id_persona'];
}
