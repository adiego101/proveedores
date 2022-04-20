<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_firmas extends Model
{
    use HasFactory;

    protected $table = "solicitud_firmas";
    protected $primaryKey = 'id_solicitud_firmas';


    protected $fillable = [
                            'id_proveedor',
                            'firmado',
           
                            ];

    //protected $hidden = ['id_pagos'];


}
