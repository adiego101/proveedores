<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponderacion_compre_local extends Model
{
    use HasFactory;
    protected $table = "ponderaciones_compre_local";

    protected $fillable = [
                            'desc_ponderacion',
                            'valor_ponderacion'
                            ];
                            
    protected $hidden = ['id_ponderacion'];
    protected $primaryKey = 'id_ponderacion';
}
