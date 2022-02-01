<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamanio_empresa extends Model
{
    use HasFactory;
    protected $table = "tamanios_empresas";

    protected $fillable = [
                            'desc_tamanio_empresa',
                            ];

    //protected $hidden = ['id_tamanio_empresa'];

    public function obtenerTamaniosEmpresas(){

        return Tamanio_empresa::All();
    }

    public function obtenerTamanioEmpresaId($id){

        return Tamanio_empresa::find($id);
    }

    public function clasificaciones_empresas(){
        return $this->hasMany(Clasificacion_empresa::class, 'id_tamanio_empresa', 'id_tamanio_empresa');
    }

    public function proveedores(){
        return $this->hasMany(Proveedor::class, 'id_tamanio_empresa', 'id_tamanio_empresa');
    }
}
