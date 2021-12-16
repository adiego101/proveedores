<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad_economica extends Model
{
    use HasFactory;

    protected $table = "actividades_economicas";

    protected $fillable = [
                            'cod_actividad',
                            'desc_actividad',
                            'descl_actividad',
                            'agrupamiento'
                            ];

    protected $primaryKey = 'id_actividad_economica';

    public function obtenerActividadesEconomicas(){

        return Actividad_economica::All();
    }

    public function obtenerActividadEconomicaId($id){

        return Actividad_economica::find($id);
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'actividades_proveedores', 'id_actividad_economica', 'id_proveedor');
    }

    public function tipos_actividades(){
        return $this->belongsToMany(Tipo_actividad::class, 'actividades_proveedores', 'id_actividad_economica', 'id_tipo_actividad');
    }

    public function sector(){
        return $this->belongsTo(Sector::class, 'id_sector', 'id_sector');
    }
}
