<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorIndiceCompreLocal extends Model
{
    use HasFactory;
    protected $table = "proveedores_indice_compre_local";
    protected $primaryKey = 'id_proveedor_indice';

    protected $fillable = [
                            'Porc_Fact_Sta_Cruz',
                            'Porc_Gastos_Sta_Cruz',
                            'Porc_Mano_Obra_Sta_Cruz',
                            'Antiguedad_Sta_Cruz',
                            'Dom_Fiscal_Sta_Cruz',
                            'Valor_Agregado',
                            'Valor_Indice',
                            ];
                            
    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
