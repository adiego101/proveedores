<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_firma extends Model
{
    use HasFactory;

    protected $table = "proveedores_firmas_nac_extr";
    protected $primaryKey = 'id_proveedor_firma_nac_extr';

    protected $fillable = [
                            'id_proveedor',
                            'denominacion_firma',
                            'desc_firma',
                            ];


    public function obtenerFirmas(){

        return Proveedor_firma::All();
    }

    public function obtenerFirmaId($id){

        return Proveedor_firma::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
