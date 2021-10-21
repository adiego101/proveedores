<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsistema_presentacion extends Model
{
    use HasFactory;

    protected $table = "subsistemas_presentaciones";

    protected $fillable = [
                            'id_subsistema',
                            'id_presentacion',
                            'desc_subsistema_presentacion',
                            ];

    protected $hidden = ['id_subsistema_presentacion'];

    public function obtenerSubsistemasPresentaciones(){

        return Subsistema_presentacion::All();
    }

    public function obtenerSubsistemaPresentacionId($id){

        return Subsistema_presentacion::find($id);
    }
}
