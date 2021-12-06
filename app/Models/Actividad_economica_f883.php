<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad_economica_f883 extends Model
{
    use HasFactory;

    protected $table = "actividades_economicas_f883";
    protected $primaryKey = 'id_actividades_economicas_f883';


    protected $fillable = [
                            'cod_actividad_f833',
                            'desc_actividad_f883',
                            'descl_actividad_f883',
                            'agrupamiento',
                            'sector',
                            ];

    protected $hidden = ['id_actividades_economicas_f883'];

    public function obtenerActividadesEconomicas(){

        return Actividad_economica_f883::All();
    }

    public function obtenerActividadEconomicaId($id){

        return Actividad_economica_f883::find($id);
    }
}
