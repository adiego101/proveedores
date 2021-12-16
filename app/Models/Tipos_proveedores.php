<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos_proveedores extends Model
{
    use HasFactory;

    protected $table = "tipos_proveedores";
    protected $primaryKey = 'id_tipo_proveedor';

    protected $fillable = [
                            'desc_tipo_proveedor',
                            ];


}
