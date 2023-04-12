<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_estado extends Model
{
    use HasFactory;

    protected $table = "proveedores_estados";
    protected $primaryKey = 'id_proveedor_estado';

    protected $fillable = [
                            'id_proveedor',
                            'id_disposicion',
                            'pe_start_date',
                            'pe_end_date',
                            'estado_cod',
                            ];

    //protected $hidden = ['id_Proveedor_estado'];

    public function obtenerProveedoresEstados(){

        return Proveedor_estado::All();
    }

    public function obtenerProveedorestadoId($id){

        return Proveedor_estado::find($id);
    }

    public function Proveedores_estados(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_Proveedores', 'id_Proveedor', 'id_Proveedor_estado')
                    ->withPivot('fecha_Proveedor','ubic_Proveedor')
                    ->withTimestamps();
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_Proveedores', 'id_proveedor', 'id_Proveedor_estado')
                    ->withPivot('fecha_Proveedor','ubic_Proveedor')
                    ->withTimestamps();
    }
}
