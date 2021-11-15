<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;

class Proveedor_rupae extends Model
{
    use HasFactory;

    protected $table = "proveedores_rupae";

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
                            'periodo_contr_administrativos',
                            'cant_operarios',
                            'periodo_contr_operarios',
                            'cant_personal_vta',
                            'periodo_contr_pventas',
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
                            'tamaño',
                            'observaciones',
                            ];

    protected $hidden = ['id'];

    public function obtenerProveedoresRupae(){

        return Proveedor_rupae::All();
    }

    /*public function obtenerProveedorRupaeId($id){

        $date = DB::table('proveedores_rupae')
        ->where('id_proveedores_rupae', $id)
        ->first();
        return $date;
    }*/

   /* public function obtenerProveedorRupaeId()
    {
        $users = DB::table('proveedores_rupae')
        ->where('id_proveedores_rupae', 16)
        ->first();

        return view('vistaPrueba', $users);
    }*/
}
