<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class localidades extends Model
{
    use HasFactory;
    protected $table = "localidades";

    protected $fillable = [
                            'codigo_localidad',
                            'localidad',
                            'provincia',
                            'pais',
                            'codigo_postal',
                            ];

    protected $hidden = ['id_localidad'];
}
