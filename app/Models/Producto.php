<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";
    protected $primaryKey = 'id_producto';

    protected $fillable = [
                            'producto_elaborado',
                            'rnpa',
                            'Producida_unidad',
                            'id_proveedor',
                            'capacidad_produccion_total',
                            ];



    public function obtenerProductos(){

        return Producto::All();
    }

    public function obtenerProductoId($id){

        return Producto::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
