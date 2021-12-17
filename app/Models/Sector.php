<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $table = "sectores";

    protected $fillable = [
                            'desc_sector',
                            ];

    //protected $hidden = ['id_sector'];

    public function obtenerSectores(){

        return Sector::All();
    }

    public function obtenerSectorId($id){

        return Sector::find($id);
    }

    public function actividades_economicas(){
        return $this->hasMany(Actividad_economica::class, 'id_sector', 'id_sector');
    }

    public function clasificaciones_empresas(){
        return $this->hasMany(Clasificacion_empresa::class, 'id_sector', 'id_sector');
    }
}
