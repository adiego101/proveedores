<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_palabra_clave extends Model
{
    use HasFactory;

    protected $table = "proveedores_palabras_claves";
    protected $primaryKey = 'id_proveedor_palabra_clave';

    protected $fillable = [
                            'id_proveedor',
                            'desc_palabra_clave',
                            'tipo_palabra_clave',
                            'nro_orden_palabra_clave',
                            ];


    public function obtenerPalabrasClaves(){

        return Proveedor_palabra_clave::All();
    }
                        
    public function obtenerPalabraClaveId($id){
                        
        return Proveedor_palabra_clave::find($id);
    }
                        
    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

}
