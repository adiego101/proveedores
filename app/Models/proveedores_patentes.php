<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_patentes extends Model
{
    use HasFactory;
    protected $table = "proveedores_patentes";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'dominio',
                            'marca',
                            'modelo',
                            'inscripto_en',
                            ];

    protected $hidden = ['id_proveedores_patentes'];
}
