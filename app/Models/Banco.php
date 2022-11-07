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

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
