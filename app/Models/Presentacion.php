<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    protected $table = "presentaciones";
    protected $primaryKey = 'id_presentacion';

    protected $fillable = [
                            'nombre_presentacion',
                            'desc_presentacion',
                            ];

    protected $hidden = ['id_presentacion'];

    public function obtenerPresentaciones(){

        return Presentacion::All();
    }

    public function obtenerPresentacionId($id){

        return Presentacion::find($id);
    }

    public function presentaciones_estados(){
        return $this->belongsToMany(Presentacion_estado::class, 'proveedores_presentaciones', 'id_presentacion_estado', 'id_presentacion')
                    ->withPivot('fecha_presentacion','ubic_presentacion')
                    ->withTimestamps();
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_presentaciones', 'id_proveedor', 'id_presentacion')
                    ->withPivot('fecha_presentacion','ubic_presentacion')
                    ->withTimestamps();
    }

    public function subsistemas(){
        return $this->belongsToMany(Subsistema::class, 'subsistemas_presentaciones', 'id_subsistema', 'id_presentacion')
                    ->withPivot('desc_subsistema_presentacion')
                    ->withTimestamps();
    }
}
