<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_email extends Model
{
    use HasFactory;

    protected $table = "proveedores_emails";
    protected $primaryKey = 'id_proveedor_email';

    protected $fillable = [
                            'email',
                            'id_proveedor',
                            'desc_email',
                            'tipo_email',
                            'nro_orden_email',
                            ];

    //protected $hidden = ['id_proveedor_email'];

    public function obtenerEmails(){

        return Proveedor_email::All();
    }

    public function obtenerEmailId($id){

        return Proveedor_email::find($id);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor_email');
    }
}
