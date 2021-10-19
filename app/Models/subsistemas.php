<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subsistemas extends Model
{
    use HasFactory;
    protected $table = "subsistemas";

    protected $fillable = [
                            'nombre_subsistema',
                            'desc_subsistema',
                            ];
                            
    protected $hidden = ['id_subsistema'];
}
