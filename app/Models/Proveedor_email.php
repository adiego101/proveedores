<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_email extends Model
{
    use HasFactory;

    protected $table = "proveedores_emails";

    protected $fillable = [
                            'id_proveedores_rupae',
                            'email',
                            'tipo_email',
                            'nro_orden_email',
                            ];

    protected $hidden = ['id_proveedores_emails'];

    public function obtenerProveedoresEmails(){

        return Proveedor_email::All();
    }

    public function obtenerProveedorEmailId($id){

        return Proveedor_email::find($id);
    }
}
