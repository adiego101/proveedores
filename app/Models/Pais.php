<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = "paises";

    protected $fillable = [
                            'nombre_pais',
                            ];
                            
    protected $hidden = ['id_pais'];
    protected $primaryKey = 'id_pais';

    public function obtenerPaises(){

        return Pais::All();
    }

    public function obtenerPaisId($id){

        return Pais::find($id);
    }

    public function provincias(){
        return $this->hasMany(Provincia::class, 'id_provincia', 'id_provincia');
    }
}
