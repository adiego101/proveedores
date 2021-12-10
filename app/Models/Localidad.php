<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = "localidades";
    protected $primaryKey = 'id_localidad';

    protected $fillable = [
                            'codigo_localidad',
                            'nombre_localidad',
                            'nombre_departamento',
                            'flg_user_generated',
                            ];

    protected $hidden = ['id_localidad'];

    public function obtenerLocalidades(){

        return Localidad::All();
    }

    public function obtenerLocalidadId($id){

        return Localidad::find($id);
    }

    public function domicilios(){
        return $this->hasMany(Domicilio::class, 'id_domicilio', 'id_domicilio');
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class, 'id_provincia', 'id_provincia');
    }
}
