<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal_email extends Model
{
    use HasFactory;

    protected $table = "sucursales_emails";

    protected $fillable = [
                            'email',
                            'desc_email',
                            'tipo_email',
                            'nro_orden_email',
                            ];

    protected $primaryKey = 'id_sucursal_email';
    //protected $hidden = ['id_sucursal_email'];

    public function obtenerEmails(){

        return Sucursal_email::All();
    }

    public function obtenerEmailId($id){

        return Sucursal_email::find($id);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id_sucursal');
    }
}
