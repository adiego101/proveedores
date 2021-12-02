<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $table = "provincias";

    protected $fillable = [
                            'nombre_provincia',
                            ];
                            
    protected $hidden = ['id_provincia'];

    public function obtenerProvincias(){

        return Provincia::All();
    }

    public function obtenerProvinciaId($id){

        return Provincia::find($id);
    }

    public function localidades(){
        return $this->hasMany(Localidad::class, 'id_localidad', 'id_localidad');
    }

    public function pais(){
        return $this->belongsTo(Pais::class, 'id_pais', 'id_pais');
    }
}
