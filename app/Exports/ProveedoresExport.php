<?php

namespace App\Exports;
use App\Models\Proveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\Log;

class ProveedoresExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Idproveedor',
            'Cuit',
            'Razon Social',
            'Nombre de Fantasía',
            'Domicilio Real',
            'Localidad',
            'Provincia',
            'Telefono',
            'Correo Electrónico',
            'Representante Legal',
            'Telefono Legal',
            'Situaciòn IVA',
            'Agrupamiento',
            'Sector',
            'Actividad Principal',
            'Actividad Secundaria',
            'Otra actividad',
            'Tipo Proveedor',
            'Facturación Anual Alcanzada',
            'Último Pago',
            'índice',
            'Proveedor',
            'Tamaño'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        
        $proveedores= Proveedor::all();
        $collection = new Collection();
        
        foreach($proveedores as $proveedor){
            $domicilioReal='';
            $localidad='';
            $provincia='';
            $tel='';
            $telLegal='';
            $correoElectronico='';
            $representanteLegal='';
            $agrupamiento = new Collection();
            $strAgrupamiento='';
            $sector= new Collection();
            $strSector='';
            $actividadPrincipal=new Collection();
            $strActividadPrincipal='';
            $actividadSecundaria=new Collection();
            $strActividadSecundaria='';
            $otraActividad=new Collection();
            $strOtraActividad='';
            $ultimoPago='';
            $tamanioEmpresa='';
            foreach($proveedor->domicilios as $domicilio){
               if($domicilio->tipo_domicilio == 'real'){
                    if($domicilio->calle != null)
                        $domicilioReal.='CALLE: '.$domicilio->calle;
                    if($domicilio->numero != null)
                        $domicilioReal.=' NÚMERO: '.$domicilio->numero;
                    if($domicilio->lote != null)
                        $domicilioReal.=' LOTE: '.$domicilio->lote;
                    if($domicilio->entre_calles != null)
                        $domicilioReal.=' ENTRE CALLES: '.$domicilio->entre_calles;
                    if($domicilio->monoblock != null)
                        $domicilioReal.=' MONOBLOCK: '.$domicilio->monoblock;
                    if($domicilio->dpto != null)
                        $domicilioReal.=' DPTO: '.$domicilio->dpto;
                    if($domicilio->puerta != null)
                        $domicilioReal.=' PUERTA: '.$domicilio->puerta;
                    if($domicilio->oficina != null)
                        $domicilioReal.=' OFICINA: '.$domicilio->oficina;
                    if($domicilio->manzana != null)
                        $domicilioReal.=' MANZANA: '.$domicilio->manzana;
                    if($domicilio->barrio != null)
                        $domicilioReal.=' BARRIO: '.$domicilio->barrio;
                    if($domicilio->codigo_postal != null)
                        $domicilioReal.=' CODIGO POSTAL: '.$domicilio->codigo_postal;
                    if($domicilio->localidad!=null){
                        $localidad = $domicilio->localidad->nombre_localidad;
                        if($domicilio->localidad->provincia!=null)
                            $provincia = $domicilio->localidad->provincia->nombre_provincia;
                    }
                }
            }
            foreach($proveedor->telefonos as $telefono){
                if($telefono->tipo_telefono == 'real'){
                    if($telefono->tipo_medio != null)
                        $tel.= $telefono->tipo_medio.':';
                    if($telefono->cod_area_tel != null)
                        $tel.= $telefono->cod_area_tel.'-';
                    if($telefono->nro_tel != null)
                        $tel.= $telefono->nro_tel.'/';
                }
                
                if($telefono->tipo_telefono == 'legal'){
                    if($telefono->tipo_medio != null)
                        $telLegal.= $telefono->tipo_medio.':';
                    if($telefono->cod_area_tel != null)
                        $telLegal.= $telefono->cod_area_tel.'-';
                    if($telefono->nro_tel != null)
                        $telLegal.= $telefono->nro_tel.'/';
                }
            }
            foreach($proveedor->emails as $email){
                if($email->tipo_email == 'real'){
                    if($email->email != null)
                        $correoElectronico.= $email->email.'/';
                }
            }
            Log::info('Domicilio => '.$domicilioReal);
            Log::info('Localidad => '.$localidad);
            Log::info('Provincia => '.$provincia);
            Log::info('Telefono => '.$tel);
            Log::info('Telefono legal => '.$telLegal);
            Log::info('Email => '.$correoElectronico);
            foreach($proveedor->representantes as $representante){
                if($representante->nombre_persona != null)
                    $representanteLegal.= $representante->nombre_persona.' ';
                if($representante->apellido_persona != null)
                    $representanteLegal.= $representante->apellido_persona.' ';
                if($representante->dni_persona != null)
                    $representanteLegal.= ' DNI: '.$representante->dni_persona.'/';
            }
            Log::info('Representante => '.$representanteLegal);
            foreach($proveedor->actividades_economicas as $actividad_economica){
                if($actividad_economica->agrupamiento != null)
                    if(!$agrupamiento->contains($actividad_economica->agrupamiento))
                        $agrupamiento->add($actividad_economica->agrupamiento);
                    
                if($actividad_economica->sector != null)
                    if(!$sector->contains($actividad_economica->sector->desc_sector))
                        $sector->add($actividad_economica->sector->desc_sector);
            }
            $strAgrupamiento=implode('/',$agrupamiento->all());
            $strSector=implode('/',$sector->all());
            Log::info('Agrupamiento => '.$strAgrupamiento);
            Log::info('Sector => '.$strSector);
            foreach($proveedor->actividades_primarias() as $actividad_primaria){
                if($actividad_primaria->desc_actividad != null)
                    if(!$actividadPrincipal->contains($actividad_primaria->desc_actividad))
                        $actividadPrincipal->add($actividad_primaria->desc_actividad);
            }
            $strActividadPrincipal=implode('/',$actividadPrincipal->all());
            Log::info('Actividades primarias => '.$strActividadPrincipal);
            foreach($proveedor->actividades_secundarias() as $actividad_secundaria){
                if($actividad_secundaria->desc_actividad != null)
                    if(!$actividadSecundaria->contains($actividad_secundaria->desc_actividad))
                        $actividadSecundaria->add($actividad_secundaria->desc_actividad);
            }
            $strActividadSecundaria=implode('/',$actividadSecundaria->all());
            Log::info('Actividades secundarias => '.$strActividadSecundaria);
            foreach($proveedor->otras_actividades() as $otra_actividad){
                if($otra_actividad->desc_actividad != null)
                    if(!$otraActividad->contains($otra_actividad->desc_actividad))
                        $otraActividad->add($otra_actividad->desc_actividad);
            }
            $strOtraActividad=implode('/',$otraActividad->all());
            Log::info('Otras actividades => '.$strOtraActividad);
            if($proveedor->ultimo_pago!=null)
                $ultimoPago=$proveedor->ultimo_pago->fecha;
            Log::info('Utlimo pago => '.$ultimoPago);
            if($proveedor->tamanio_empresa!=null)
                $tamanioEmpresa=$proveedor->tamanio_empresa->desc_tamanio_empresa;
            Log::info('Tamanio empresa => '.$tamanioEmpresa);
            $proveedor = [
                'Idproveedor'=>$proveedor->nro_rupae_proveedor,
                'Cuit'=>$proveedor->cuit,
                'Razon Social'=>$proveedor->razon_social,
                'Nombre de Fantasía'=>$proveedor->nombre_fantasia,
                'Domicilio Real'=>$domicilioReal,
                'Localidad'=>$localidad,
                'Provincia'=>$provincia,
                'Telefono'=>$tel,
                'Correo Electrónico'=>$correoElectronico,
                'Representante Legal'=>$representanteLegal,
                'Telefono Legal'=>$telLegal,
                'Situación IVA'=>$proveedor->situacion_iva,
                'Agrupamiento'=>$strAgrupamiento,
                'Sector'=>$strSector,
                'Actividad Principal'=>$strActividadPrincipal,
                'Actividad Secundaria'=>$strActividadSecundaria,
                'Otra actividad'=>$strOtraActividad,
                'Tipo Proveedor'=>$proveedor->tipo_proveedor,
                'Facturación Anual Alcanzada'=>$proveedor->facturacion_anual_alcanzada,
                'Último Pago'=>$ultimoPago,
                'índice'/*=>$proveedor->ultimo_indice->Valor_Indice*/,
                'Proveedor',
                'Tamaño'=>$tamanioEmpresa
            ];
            $collection->add($proveedor);
        
        }
        return $collection;
    }
}
