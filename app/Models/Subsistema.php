<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsistema extends Model
{
    use HasFactory;

    protected $table = "subsistemas";
    protected $primaryKey = 'id_subsistema';

    protected $fillable = [
                            'nombre_subsistema',
                            'desc_subsistema',
                            ];

    protected $hidden = ['id_subsistema'];

    public function obtenerSubsistemas(){

        return Subsistema::All();
    }

    public function obtenerSubsistemaId($id){

        return Subsistema::find($id);
    }
}
