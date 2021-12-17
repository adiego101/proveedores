<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores_tipos_proveedores extends Model
{
    use HasFactory;

    protected $table = "proveedores_tipos_proveedores";
    protected $primaryKey = 'id_proveedor_tipo_proveedor';

    protected $fillable = [
                            'id_proveedor',
                            'id_tipo_proveedor',
                            'desc_proveedor_tipo_proveedor',
                            'nro_orden_tipo_proveedor',
                            ];


}
