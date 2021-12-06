<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal_telefono extends Model
{
    use HasFactory;
    protected $table = "sucursales_telefonos";

    protected $fillable = [
                            'nro_tel',
                            'cod_area_tel',
                            'tipo_medio',
                            'desc_telefono',
                            'tipo_telefono',
                            'nro_orden_telefono'
                            ];
                            
    protected $hidden = ['id_sucursal_telefono'];
    protected $primaryKey = 'id_sucursal_telefono';

    public function obtenerProveedor_telefonos(){

        return Sucursal_telefono::All();
    }

    public function obtenerProveedor_telefonoId($id){

        return Sucursal_telefono::find($id);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id_sucursal');
    }
}
