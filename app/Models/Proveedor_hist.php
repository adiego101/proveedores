<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_hist extends Model
{
    use HasFactory;

    protected $table = "proveedores_hist";

    protected $fillable = [
                            'start_date',
                            'end_date',
                            'nro_rupae_proveedor',
                            'razon_social',
                            'nombre_fantasia',
                            'pagina_web',
                            'tipo_de_sociedad',
                            'cuit',
                            'situacion_iva',
                            'exento_en_cod_de_actividad',
                            'en_la_provincia_de',
                            'retencion',
                            'nro_ingresos_brutos',
                            'jurisdiccion',
                            'tipo_contribuyente',
                            'nro_habilitacion_municipal',
                            'localidad_habilitacion',
                            'nro_inscripcion_personas_juridicas',
                            'provincia_inscrip_personas_jur',
                            'registro_publico_de_comercio',
                            'provincia_registro_publico',
                            'inspeccion_gral_justicia',
                            'provincia_inspeccion_justicia',
                            'facturacion_anual_alcanzada',
                            'rne',
                            'servicio_atencion_cliente',
                            'servicio_post_venta',
                            'servicio_personal_especializado',
                            'servicio_entrega_a_domicilio',
                            'servicio_capacitacion_personal',
                            'producto_transformacion_significativa',
                            'producto_compra_y_vende_unic',
                            'producto_post_venta',
                            'producto_venta_asistida',
                            'producto_garantia',
                            'empleados_nomina',
                            'puestos_trabajo_Sta_Cruz',
                            'cant_administrativos',
                            'periodo_de_contratacion',
                            'cant_operarios',
                            'periodo_contratacion1',
                            'cant_personal_vta',
                            'periodo_contratacion2',
                            'cant_empleados_domicilio_sta_cruz',
                            'masa_salarial_bruta',
                            'fecha_inscripcion',
                            'tipo_inscripcion',
                            'nro_inscripcion',
                            'tipo_proveedor',
                            'fecha_baja',
                            'motivo_baja',
                            'porc_facturacion',
                            'porc_gasto',
                            'porc_mo', //Porcentaje de Mano de Obra en Santa Cruz
                            'antiguedad',
                            'dom_fiscal',
                            'valor_agregado',
                            'observaciones',
                            ];

    //protected $hidden = ['id_proveedor'];
    protected $primaryKey = 'id_proveedor';

    public function obtenerProveedoresHist(){

        return Proveedor_hist::All();
    }

    public function obtenerProveedorHistId($id){

        return Proveedor_hist::find($id);
    }
}
