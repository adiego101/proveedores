<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = "sucursales";

    protected $fillable = [ 'id_sucursal',
                            'nombre_sucursal',
                            'calle',
                            'numero',
                            'lote',
                            'entre_calles',
                            'id_proveedor',
                            'id_localidad',
                            'monoblock',
                            'dpto',
                            'puerta',
                            'oficina',
                            'manzana',
                            'barrio',
                            'codigo_postal'
                            ];

    //protected $hidden = ['id_sucursal'];
    protected $primaryKey = 'id_sucursal';

    public function obtenerSucursales(){

        return Sucursal::All();
    }

    public function obtenerSucursalId($id){

        return Sucursal::find($id);
    }

    public function telefonos(){
        return $this->hasMany(Sucursal_telefono::class, 'id_sucursal', 'id_sucursal');
    }

    public function emails(){
        return $this->hasMany(Sucursal_email::class, 'id_sucursal', 'id_sucursal');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function localidad(){
        return $this->belongsTo(Localidad::class, 'id_localidad', 'id_localidad');
    }
}
