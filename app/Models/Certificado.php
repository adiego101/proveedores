<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $table = "certificados";

    protected $primaryKey = 'id_certificado';

    protected $fillable = [
                            'nro_rupae_proveedor',
                            'fecha_inscripcion',
                            'razon_social',
                            'cuit',
                            'nombre_fantasia',
                            'calle_real',
                            'numero_real',
                            'nombre_localidad_real',
                            'nombre_provincia_real',
                            'nro_tel_real',
                            'email_real',
                            'nombre_provincia_legal',
                            'nombre_localidad_legal',
                            'calle_legal',
                            'numero_legal',
                            'nro_tel_legal',
                            'email_legal',
                            'nombre_representante_legal',
                            'dni_representante_legal',
                            'dni_reprensentante_legal',
                            'tipo_de_sociedad',
                            'situacion_iva',
                            'retencion',
                            'nro_ingresos_brutos',
                            'jurisdiccion',
                            'tipo_contribuyente',
                            'nro_habilitacion_municipal',
                            'nombre_localidad_habilit_municip',
                            'nro_inscripcion_personas_juridicas',
                            'provincia_inscrip_personas_jur',
                            'registro_publico_de_comercio',
                            'provincia_registro_publico',
                            'inspeccion_gral_justicia',
                            'provincia_inspeccion_justicia',
                            'desc_actividad_economica_princ',
                            'desc_actividad_economica_sec',
                            'porc_mo', //Porcentaje de Mano de Obra en Santa Cruz
                            'porc_facturacion',
                            'porc_gasto',
                            'antiguedad',
                            'dom_fiscal',
                            'valor_agregado',
                            'valor_indice_rupae',
                            'desc_jerarquia_compre_local',
                            'fecha_emision_certificado',
                            'nombreArchivo',
                            'idTransaccion',
                            'firmado'
                        ];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
