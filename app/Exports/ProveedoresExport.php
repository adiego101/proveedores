<?php

namespace App\Exports;
use App\Models\Proveedor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;

//librerias para seguir el comportamiento de la aplicacion mediante log
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProveedoresExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;
    protected $proveedores;

    public function __construct($proveedores=null){
        $this->proveedores = $proveedores;
    }

    public function headings(): array
    {
        return [
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
            'Situación IVA',
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
        //Forma de imprimir consultas sql
        DB::connection()->enableQueryLog();
        
        $collection = new Collection();
        foreach($this->proveedores as $proveedor){
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
            
            $domicilio=$proveedor->domicilio_real;
            if($domicilio!=null){
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

            foreach($proveedor->telefonos_real as $telefono_real){
                if($telefono_real->tipo_medio != null)
                    $tel.= $telefono_real->tipo_medio.':';
                if($telefono_real->cod_area_tel != null)
                    $tel.= $telefono_real->cod_area_tel.'-';
                if($telefono_real->nro_tel != null)
                    $tel.= $telefono_real->nro_tel.'/';
            }
                
            foreach($proveedor->telefonos_legal as $telefono_legal){
                if($telefono_legal->tipo_medio != null)
                    $telLegal.= $telefono_legal->tipo_medio.':';
                if($telefono_legal->cod_area_tel != null)
                    $telLegal.= $telefono_legal->cod_area_tel.'-';
                if($telefono_legal->nro_tel != null)
                    $telLegal.= $telefono_legal->nro_tel.'/';
            }
            foreach($proveedor->emails_real as $email)
                if($email->email != null)
                    $correoElectronico.= $email->email.'/';
            /*Log::info('Domicilio => '.$domicilioReal);
            Log::info('Localidad => '.$localidad);
            Log::info('Provincia => '.$provincia);
            Log::info('Telefono => '.$tel);
            Log::info('Telefono legal => '.$telLegal);
            Log::info('Email => '.$correoElectronico);*/

            foreach($proveedor->representantes as $representante){
                if($representante->nombre_persona != null)
                    $representanteLegal.= $representante->nombre_persona.' ';
                if($representante->apellido_persona != null)
                    $representanteLegal.= $representante->apellido_persona.' ';
                if($representante->dni_persona != null)
                    $representanteLegal.= ' DNI: '.$representante->dni_persona.'/';
            }
            //Log::info('Representante => '.$representanteLegal);

            foreach($proveedor->actividades_primarias as $actividad_primaria){
                if($actividad_primaria->agrupamiento != null)
                    if(!$agrupamiento->contains($actividad_primaria->agrupamiento))
                        $agrupamiento->add($actividad_primaria->agrupamiento);
                    
                if($actividad_primaria->sector != null)
                    if(!$sector->contains($actividad_primaria->sector->desc_sector))
                        $sector->add($actividad_primaria->sector->desc_sector);
                
                if($actividad_primaria->desc_actividad != null)
                    if(!$actividadPrincipal->contains($actividad_primaria->desc_actividad))
                        $actividadPrincipal->add($actividad_primaria->desc_actividad);
            }
            
            $strActividadPrincipal=implode('/',$actividadPrincipal->all());
            //Log::info('Actividades primarias => '.$strActividadPrincipal);

            foreach($proveedor->actividades_secundarias as $actividad_secundaria){
                if($actividad_secundaria->agrupamiento != null)
                    if(!$agrupamiento->contains($actividad_secundaria->agrupamiento))
                        $agrupamiento->add($actividad_secundaria->agrupamiento);
                    
                if($actividad_secundaria->sector != null)
                    if(!$sector->contains($actividad_secundaria->sector->desc_sector))
                        $sector->add($actividad_secundaria->sector->desc_sector);
                
                if($actividad_secundaria->desc_actividad != null)
                    if(!$actividadSecundaria->contains($actividad_secundaria->desc_actividad))
                        $actividadSecundaria->add($actividad_secundaria->desc_actividad);
            }
            $strActividadSecundaria=implode('/',$actividadSecundaria->all());
            //Log::info('Actividades secundarias => '.$strActividadSecundaria);

            foreach($proveedor->otras_actividades as $otra_actividad){
                if($otra_actividad->tipos_actividades->isNotEmpty()){
                    if($otra_actividad->agrupamiento != null)
                        if(!$agrupamiento->contains($otra_actividad->agrupamiento))
                            $agrupamiento->add($otra_actividad->agrupamiento);
                        
                    if($otra_actividad->sector != null)
                        if(!$sector->contains($otra_actividad->sector->desc_sector))
                            $sector->add($otra_actividad->sector->desc_sector);
                    
                    if($otra_actividad->desc_actividad != null)
                        if(!$otraActividad->contains($otra_actividad->desc_actividad))
                            $otraActividad->add($otra_actividad->desc_actividad);
                }
            }
            $strOtraActividad=implode('/',$otraActividad->all());
            //Log::info('Otras actividades => '.$strOtraActividad);
            $strAgrupamiento=implode('/',$agrupamiento->all());
            $strSector=implode('/',$sector->all());
            /*Log::info('Agrupamiento => '.$strAgrupamiento);
            Log::info('Sector => '.$strSector);*/
            
            if($proveedor->ultimo_pago!=null)
                $ultimoPago=$proveedor->ultimo_pago->fecha;
            //Log::info('Utlimo pago => '.$ultimoPago);
            if($proveedor->tamanio_empresa!=null)
                $tamanioEmpresa=$proveedor->tamanio_empresa->desc_tamanio_empresa;
            //Log::info('Tamanio empresa => '.$tamanioEmpresa);

            $proveedor = [
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
                'índice'=>$proveedor->valor_indice_rupae,
                'Proveedor'=>$proveedor->desc_jerarquia_compre_local,
                'Tamaño'=>$tamanioEmpresa
            ];
            $collection->add($proveedor);
        
        }
        $queries = DB::getQueryLog();
        Log::info($queries);
        return $collection;
    }

    public function styles(Worksheet $sheet){
        return [
            // Style the first row as bold text.
            1    => [   'font' => ['bold' => true]]
        ];
    }
}
