<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    protected $table = "presentaciones";

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
}
