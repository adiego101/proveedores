<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jerarquia_compre_local extends Model
{
    use HasFactory;
    protected $table = "jerarquia_compre_local";

    protected $fillable = [
                            'desc_jerarquia_compre_local',
                            'valor_desde',
                            'valor_hasta'
                            ];
                            
    protected $hidden = ['id_jerarquia_compre_local'];
    protected $primaryKey = 'id_jerarquia_compre_local';
}
