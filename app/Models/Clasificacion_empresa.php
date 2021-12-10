<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion_empresa extends Model
{
    use HasFactory;

    protected $table = "clasificaciones_empresas";
    protected $primaryKey = 'id_clasificacion_empresa';

    protected $fillable = [
                            'simbolo',
                            'facturacion_max',
                            'fact_max_2018',
                            ];

    protected $hidden = ['id_clasificacion_empresa'];

    public function obtenerClasificacionesEmpresas(){

        return Clasificacion_empresa::All();
    }

    public function obtenerClasificacionEmpresaId($id){

        return Clasificacion_empresa::find($id);
    }

    public function sector(){
        return $this->belongsTo(Sector::class, 'id_sector', 'id_sector');
    }

    public function tamanio_empresa(){
        return $this->belongsTo(Tamanio_empresa::class, 'id_tamanio_empresa', 'id_tamanio_empresa');
    }
}
