<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion_estado extends Model
{
    use HasFactory;

    protected $table = "presentaciones_estados";
    protected $primaryKey = 'id_presentacion_estado';

    protected $fillable = [
                            'cod_presentacion_estado',
                            'desc_presentacion_estado',
                            ];

    protected $hidden = ['id_presentacion_estado'];

    public function obtenerPresentacionesEstados(){

        return Presentacion_estado::All();
    }

    public function obtenerPresentacionEstadoId($id){

        return Presentacion_estado::find($id);
    }
}
