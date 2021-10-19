<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subsistemas_presentaciones extends Model
{
    use HasFactory;
    protected $table = "subsistemas_presentaciones";

    protected $fillable = [
                            'id_subsistema',
                            'id_presentacion',
                            'desc_subsistema_presentacion',
                            ];

    protected $hidden = ['id_subsistema_presentacion'];
}
