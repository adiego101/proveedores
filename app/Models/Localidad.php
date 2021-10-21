<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = "localidades";

    protected $fillable = [
                            'codigo_localidad',
                            'localidad',
                            'provincia',
                            'pais',
                            'codigo_postal',
                            ];

    protected $hidden = ['id_localidad'];

    public function obtenerLocalidades(){

        return Localidad::All();
    }

    public function obtenerLocalidadId($id){

        return Localidad::find($id);
    }
}
