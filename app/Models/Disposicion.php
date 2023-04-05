<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposicion extends Model
{
    use HasFactory;

    protected $table = "disposiciones";
    protected $primaryKey = 'id_disposicion';


    protected $fillable = [
                            'id_proveedor',
                            'nro_disposicion',
                            'fecha_ini_vigencia',
                            'fecha_fin_vigencia',
                            'disposicion_tipo',
                            'GDE_Exp',
                            'observaciones'
                            ];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    
}
