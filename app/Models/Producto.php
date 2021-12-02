<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
                            'producto_elaborado',
                            'rnpa',
                            'Producida_unidad',
                            'capacidad_produccion_total',
                            ];

    protected $hidden = ['id_producto'];
    protected $primaryKey = 'id_producto';


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
