<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion_estado extends Model
{
    use HasFactory;

    protected $table = "presentaciones_estados";
    protected $primaryKey = 'id_presentacion_estado';

    protected $fillable = [
                            'cod_presentacion_estado',
                            'desc_presentacion_estado',
                            ];

    protected $hidden = ['id_presentacion_estado'];

    public function obtenerPresentacionesEstados(){

        return Presentacion_estado::All();
    }

    public function obtenerPresentacionEstadoId($id){

        return Presentacion_estado::find($id);
    }

    public function presentaciones(){
        return $this->belongsToMany(Presentacion::class, 'proveedores_presentaciones', 'id_presentacion', 'id_presentacion_estado')
                    ->withPivot('fecha_presentacion','ubic_presentacion')
                    ->withTimestamps();
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_presentaciones', 'id_proveedor', 'id_presentacion_estado')
                    ->withPivot('fecha_presentacion','ubic_presentacion')
                    ->withTimestamps();
    }
}
