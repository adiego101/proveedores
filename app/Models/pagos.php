<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;
    protected $table = "pagos";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'fecha',
                            'importe',
                            'observaciones',
                            ];
    protected $hidden = ['id_pagos'];
}
