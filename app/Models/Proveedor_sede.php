<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_sede extends Model
{
    use HasFactory;

    protected $table = "proveedores_sede";
    protected $primaryKey = 'id_proveedor_sede';

    protected $fillable = [
                            'Localidad',
                            'Domicilio',
                            'id_proveedor',
                            ];


}
