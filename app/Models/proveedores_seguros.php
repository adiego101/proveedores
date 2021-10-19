<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedores_seguros extends Model
{
    use HasFactory;
    protected $table = "proveedores_seguros";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'poliza',
                            'agencia',
                            'asegurado',
                            'vigencia_hasta',
                            ];

    protected $hidden = ['id_proveedores_seguros'];
}
