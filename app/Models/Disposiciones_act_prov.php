<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposiciones_act_prov extends Model
{
    use HasFactory;

    protected $table = "disposiciones_act_prov";

    protected $fillable = [
                            'id_disposicion',
                            'id_actividad_proveedor',

                            ];

    //protected $hidden = ['id_actividad_proveedor'];
    protected $primaryKey = 'id_disposicion_act_prov';

    public function obtenerdisposiciones_act_prov(){

        return disposiciones_act_prov::All();
    }

    public function obtenerdisposiciones_act_provId($id){

        return disposiciones_act_prov::find($id);
    }


}
