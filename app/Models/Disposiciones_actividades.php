<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposiciones_actividades extends Model
{
    use HasFactory;

    protected $table = "disposiciones_actividades";

    protected $fillable = [
                            'id_actividad_proveedor',
                            'id_disposicion',
                            'start_date',
                            'end_date',
                            ];

    //protected $hidden = ['id_actividad_proveedor'];
    protected $primaryKey = 'iddisposiciones_actividades';

    public function obtenerDisposiciones_actividades(){

        return Disposiciones_actividades::All();
    }

    public function obtenerDisposiciones_actividadesId($id){

        return Disposiciones_actividades::find($id);
    }


}
