<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\DB;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedores";

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

    protected $primaryKey = 'id_proveedor';
    //protected $hidden = ['id_proveedor'];

    public function obtenerProveedores(){

        return Proveedor::All();
    }

    /*public function obtenerProveedorId($id){

        $date = DB::table('proveedores_rupae')
        ->where('id_proveedores_rupae', $id)
        ->first();
        return $date;
    }*/

   /* public function obtenerProveedorId()
    {
        $users = DB::table('proveedores_rupae')
        ->where('id_proveedores_rupae', 16)
        ->first();

        return view('vistaPrueba', $users);
    }*/

    public function domicilios(){
       return $this->hasMany(Proveedor_domicilio::class,'id_proveedor');
    }
    public function telefonos(){
        return $this->hasMany(Proveedor_telefono::class, 'id_proveedor');
    }

    public function personas(){
        return $this->belongsToMany(Persona::class, 'personas_proveedores', 'id_proveedor', 'id_persona')
                    ->withPivot('rol_persona_proveedor')
                    ->withTimestamps();
    }

    public function representantes(){
        return $this->belongsToMany(Persona::class, 'personas_proveedores', 'id_proveedor', 'id_persona')
                    ->wherePivot('rol_persona_proveedor', 'representante');
    }

    public function actividades_economicas(){
        return $this->belongsToMany(Actividad_economica::class, 'actividades_proveedores', 'id_proveedor', 'id_actividad_economica');
    }

    public function tipos_actividades(){
        return $this->belongsToMany(Tipo_actividad::class, 'actividades_proveedores', 'id_proveedor', 'id_tipo_actividad');
    }

    public function actividades_primarias(){
        $collection = new Collection();
        $actividades = $this->actividades_economicas;
        foreach($actividades as $actividad)
            foreach($actividad->tipos_actividades as $tipo_actividad)
                if($tipo_actividad->desc_tipo_actividad=='Primaria')
                    $collection->add($actividad);
        return $collection;
    }

    public function actividades_secundarias(){
        $collection = new Collection();
        $actividades = $this->actividades_economicas;
        foreach($actividades as $actividad)
            foreach($actividad->tipos_actividades as $tipo_actividad)
                if($tipo_actividad->desc_tipo_actividad=='Secundaria')
                    $collection->add($actividad);
        return $collection;
    }

    public function otras_actividades(){
        $collection = new Collection();
        $actividades = $this->actividades_economicas;
        foreach($actividades as $actividad)
            foreach($actividad->tipos_actividades as $tipo_actividad)
                if($tipo_actividad->desc_tipo_actividad!='Primaria' && $tipo_actividad->desc_tipo_actividad!='Secundaria')
                    $collection->add($actividad);
        return $collection;
    }

    public function emails(){
        return $this->hasMany(Proveedor_email::class, 'id_proveedor');
    }



    public function sucursales(){
        return $this->hasMany(Sucursal::class, 'id_proveedor', 'id_proveedor');
    }

    public function productos(){
        return $this->hasMany(Producto::class, 'id_proveedor', 'id_proveedor');
    }

    public function proveedores_patentes(){
        return $this->hasMany(Proveedor_patente::class, 'id_proveedor', 'id_proveedor');
    }

    public function proveedores_seguros(){
        return $this->hasMany(Proveedor_seguro::class, 'id_proveedor', 'id_proveedor');
    }

    public function pagos(){
        return $this->hasMany(Pago::class, 'id_pagos', 'id_pagos');
    }

    public function ultimo_pago(){
        return $this->hasOne(Pago::class, 'id_proveedor')
                    ->latest();
    }

    /*public function indices(){
        return $this->hasMany(ProveedorIndiceCompreLocal::class, 'id_proveedor', 'id_proveedor');
    }

    public function ultimo_indice(){
        return $this->hasMany(ProveedorIndiceCompreLocal::class, 'id_proveedor', 'id_proveedor')
                    ->latest()
                    ->first();
    }*/

    public function presentaciones_estados(){
        return $this->belongsToMany(Presentacion_estado::class, 'proveedores_presentaciones', 'id_presentacion_estado', 'id_proveedor')
                    ->withPivot('fecha_presentacion','ubic_presentacion')
                    ->withTimestamps();
    }

    public function tamanio_empresa(){
        return $this->belongsTo(Tamanio_empresa::class, 'id_tamanio_empresa', 'id_tamanio_empresa');
    }
}
