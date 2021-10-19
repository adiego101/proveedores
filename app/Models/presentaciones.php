<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presentaciones extends Model
{
    use HasFactory;
    protected $table = "presentaciones";

    protected $fillable = [
                            'nombre_presentacion',
                            'desc_presentacion',
                            ];

    protected $hidden = ['id_presentacion'];
}
