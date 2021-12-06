<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";
    protected $primaryKey = 'id_persona';

    protected $fillable = [
                            'dni_persona',
                            'cuil_persona',
                            'nombre_persona',
                            'apellido_persona',
                            'genero_persona',
                            ];

    protected $hidden = ['id_persona'];
    protected $primaryKey = 'id_persona';

    public function obtenerPersonas(){

        return Persona::All();
    }

    public function obtenerPersonaId($id){

        return Persona::find($id);
    }

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'personas_proveedores', 'id_persona', 'id_proveedor')
                    ->withPivot('rol_persona_proveedor')
                    ->withTimestamps();
    }
}
