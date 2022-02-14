<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Localidad;
use App\Exports\ProveedoresExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExportController extends Controller
{
    //
    public function exportar(Request $request){
       
        $tipo_descarga=$request->input('tipo_descarga');
        
        if($tipo_descarga=='TODOS LOS PROVEEDORES')
            return $this->proveedores();
        if($tipo_descarga=='PROVEEDORES POR LOCALIDAD'){
            $localidad=$request->input('localidad_descarga');
            if($localidad!='')
                return $this->proveedores_localidad($localidad);
        }
        if($tipo_descarga=='PROVEEDORES POR ACTIVIDAD'){
            $actividad=$request->input('actividad_descarga');
            if($actividad!='')
                return $this->proveedores_actividad($actividad);
        }
        if($tipo_descarga=='PROVEEDORES POR SECTOR'){
            $sector=$request->input('sector_descarga');
            if($sector!='')
                return $this->proveedores_sector($sector);
        }
    }

    public function proveedores(){
        $proveedores= Proveedor::with(['domicilio_real','domicilio_legal','telefonos_real','telefonos_legal','emails_real','representantes','actividades_primarias','actividades_secundarias','otras_actividades','ultimo_pago','tamanio_empresa'])
                                ->where('dado_de_baja','=',0)
                                ->get();
        Log::info('$proveedores='.$proveedores);
        return (new ProveedoresExport($proveedores))->download('proveedores.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function proveedores_localidad($localidad){
        $nombre_localidad=Localidad::findOrFail($localidad);
        $proveedores= Proveedor::with([ 'domicilio_real',
                                        'domicilio_legal',
                                        'telefonos_real',
                                        'telefonos_legal',
                                        'emails_real',
                                        'representantes',
                                        'actividades_primarias',
                                        'actividades_secundarias',
                                        'otras_actividades',
                                        'ultimo_pago',
                                        'tamanio_empresa'])
                                ->whereHas('domicilio_real', function ($query) use($localidad){
                                    $query->where('id_localidad', '=', $localidad);
                                })
                                ->where('dado_de_baja','=',0)
                                ->get();
        return (new ProveedoresExport($proveedores))->download('proveedores.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function proveedores_actividad($actividad){
        $proveedores= Proveedor::with([ 'domicilio_real',
                                        'domicilio_legal',
                                        'telefonos_real',
                                        'telefonos_legal',
                                        'emails_real',
                                        'representantes',
                                        'actividades_primarias',
                                        'actividades_secundarias',
                                        'otras_actividades',
                                        'ultimo_pago',
                                        'tamanio_empresa'])
                                ->whereHas('actividades_primarias', function ($query) use($actividad){
                                    $query->where('actividades_economicas.id_actividad_economica', '=', $actividad);
                                })
                                ->orWhereHas('actividades_secundarias', function ($query) use($actividad){
                                    $query->where('actividades_economicas.id_actividad_economica', '=', $actividad);
                                })
                                ->orWhereHas('otras_actividades', function ($query) use($actividad){
                                    $query->where('actividades_economicas.id_actividad_economica', '=', $actividad);
                                })
                                ->where('dado_de_baja','=',0)
                                ->get();
        return (new ProveedoresExport($proveedores))->download('proveedores.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function proveedores_sector($sector){
        $proveedores= Proveedor::with([ 'domicilio_real',
                                        'domicilio_legal',
                                        'telefonos_real',
                                        'telefonos_legal',
                                        'emails_real',
                                        'representantes',
                                        'actividades_primarias',
                                        'actividades_secundarias',
                                        'otras_actividades',
                                        'ultimo_pago',
                                        'tamanio_empresa'])
                                ->whereHas('actividades_primarias', function ($query) use($sector){
                                    $query->where('id_sector', '=', $sector);
                                })
                                ->orWhereHas('actividades_secundarias', function ($query) use($sector){
                                    $query->where('id_sector', '=', $sector);
                                })
                                ->orWhereHas('otras_actividades', function ($query) use($sector){
                                    $query->where('id_sector', '=', $sector);
                                })
                                ->where('dado_de_baja','=',0)
                                ->get();
        return (new ProveedoresExport($proveedores))->download('proveedores.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function proveedores_palabra_clave(){

    }
}
