<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = "bancos";
    protected $primaryKey = 'id_banco';

    protected $fillable = [
                            'id_banco',
                            'codigo_banco',
                            'nombre_banco',
                            'desc_banco',
                            ];


    public function obtenerBancos(){

        return Banco::All();
    }

    public function obtenerBancoId($id){

        return Banco::find($id);
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_bancos', 'id_banco', 'id_proveedor');
    }

    public function localidades(){
        return $this->belongsToMany(Localidad::class, 'proveedores_bancos', 'id_banco', 'id_localidad');
    }
}
