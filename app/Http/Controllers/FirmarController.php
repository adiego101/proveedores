<?php

namespace App\Http\Controllers;

use PDF;
use DataTables;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Provincia;
use App\Models\Certificado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Tipo_actividad;
use Illuminate\Support\Carbon;
use App\Models\Proveedor_email;
use App\Models\Solicitud_firmas;
use App\Models\Proveedor_telefono;
use App\Models\Actividad_economica;
use App\Models\Proveedor_domicilio;
use Illuminate\Support\Facades\Log;
use App\Models\Jerarquia_compre_local;
use App\Models\Actividades_proveedores;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class FirmarController extends Controller
{

    public function FirmarPDF($pdf)
    {

    }

    public function token()
    {
        //Login
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://firmadigital.santacruz.gob.ar/firmar/v1/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                        "usuario": "rupae",
                        "password": "iC!wt*!qWm4p"
            }', CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $array = json_decode($response, true);

        $token = $array['access_token'];

        return $token;
    }

    public function pdfBase64($id)
    {
        $proveedor = Proveedor::find($id);
        if ($proveedor->dado_de_baja != 1) {

            // crea una ID única con un número aleatorio como prefijo, más seguro que un prefijo estático uniqid (rand (), true)
            //$idInscripcion = uniqid (rand ());

            //return $idInscripcion;

            $idAlta = $proveedor->nro_rupae_proveedor;

            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')->first();

            $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')->first();

            $proveedor_localidad_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();

            $proveedor_actividad_id = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->first();

            if (empty($proveedor_actividad_id)) {
                $proveedor_tipo_actividad = "";
            } else {
                $proveedor_tipo_actividad = Tipo_actividad::where('id_tipo_actividad', $proveedor_actividad_id->id_tipo_actividad)->first();
            }

            if (!$proveedor_actividad_id) {
                $Actividad_economica = "";
            } else {
                $Actividad_economica = Actividad_economica::where('id_actividad_economica', $proveedor_actividad_id->id_actividad_economica)->first();
                $Actividad_economica = $Actividad_economica;
            }

            $proveedor_actividad_secundaria = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 2)->get();
            $actividades_Secundarias = "";

            foreach ($proveedor_actividad_secundaria as $actividad_secundaria) {

                $Actividad_economica2 = Actividad_economica::where('id_actividad_economica', $actividad_secundaria->id_actividad_economica)->first();

                if ($proveedor_actividad_secundaria->last() == $actividad_secundaria) {
                    $actividades_Secundarias = $actividades_Secundarias . $Actividad_economica2->desc_actividad . ".";
                } else {
                    $actividades_Secundarias = $Actividad_economica2->desc_actividad . ";  " . $actividades_Secundarias;
                }
            }

            $data = [
                'titulo' => 'Certificado inscripción',
                'cuit' => $proveedor->cuit,
                'nombre_fantasia' => $proveedor->nombre_fantasia,
                'razon_social' => $proveedor->razon_social,
                'cod_actividad_principal' => isset($Actividad_economica->cod_actividad) ? $Actividad_economica->cod_actividad : '',
                'actividad_principal' => isset($Actividad_economica->desc_actividad) ? $Actividad_economica->desc_actividad : '',
                'actividad_secundaria' => isset($actividades_Secundarias) ? $actividades_Secundarias : '',
                'calle_ruta' => $proveedor_domicilio_real->calle . ' ' . $proveedor_domicilio_real->numero,
                'telefono' => isset($proveedor_telefono_real->nro_tel) ? $proveedor_telefono_real->nro_tel : '',
                'cod_tel_real' => isset($proveedor_telefono_real->cod_area_tel) ? $proveedor_telefono_real->cod_area_tel : null,
                'fecha_inscripcion' => isset($proveedor->fecha_inscripcion) ? $proveedor->fecha_inscripcion : '',
                'localidad' => isset($proveedor_localidad_real->nombre_localidad) ? $proveedor_localidad_real->nombre_localidad : '',

            ];

            /*return PDF::loadView('certificadoInscripcion', array('data'=> $data))
            ->stream('certificado-inscripcion.pdf');*/

            //return PDF::loadView('certificadoInscripcion', array('data'=> $data))
            //->save(storage_path('app/public/') . 'certificado-inscripcion.pdf');

            //$dompdf = App::make("dompdf.wrapper");
            $dompdf = PDF::loadView('certificadoInscripcion', array('data' => $data));
            // return storage_path('app/public/');

            $documento = base64_encode($dompdf->output());

            return $documento;
        }
    }

    public function Firmar($solicitud, Request $request)
    {

        $solicitud_firma = Solicitud_firmas::where('solicitud', $solicitud)->first();
        $id = $solicitud_firma->id_proveedor;

        $idTransaccion = $solicitud;

        //Datos capturados del formulario index

        $token = $this->token();

        $documento = $this->pdfBase64($id);
        // Se debe modificar con el dominio donde se a levantado el ejemplo

        $url_redirect = "https://rupae-interfaces.com/verificarFirma/" . $idTransaccion;

        //Envio de informacion a Firmar-API
        $tipo_documento = "PDF";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://firmadigital.santacruz.gob.ar/firmar/firmador',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "cuil": "' . $request->user()->cuil . '",
            "documento": "' . $documento . '",
            "metadata": {
            "sistemaOrigen" : "origen"

            },
            "type": "' . $tipo_documento . '",
            "urlRedirect": "' . $url_redirect . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token . '',
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        //Capturar idTransaccion
        $json = json_decode($response);
        $nombreArchivo = $json->IdArchivo;
        $this->crearHistorico($id,$nombreArchivo,$idTransaccion);
        //$arr = array('idTransaccion' => $idTransaccion, 'idArchivo' => $json->IdArchivo);

        //Creamos el JSON
        //$json_string = json_encode($arr);
        //Storage::disk('local')->put('transaccion' . $idTransaccion . '.json', $json_string);
    
        curl_close($curl);

        return redirect()->away($json->location);

    }

    public function asignarNroRupaeProveedor($proveedor)
    {
        try{
        if($proveedor->dado_de_baja != 1){

        //asigna numero de registro
        $max_numero_registro = Proveedor::max('nro_rupae_proveedor');
        if ($max_numero_registro == null) {
            $max_numero_registro = 0;
        }

        do {
            $error_numero_registro = false;
            try {
                $proveedor->nro_rupae_proveedor = $max_numero_registro + 1;
                $proveedor->save();
            } catch (\Exception$e) {
                Log::error('Error inesperado ' . $e->getMessage());
                $max_numero_registro = Proveedor::max('nro_rupae_proveedor');
                $error_numero_registro = true;
            }
        } while ($error_numero_registro);
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }
} catch (\Exception$e) {
    Log::error('Error inesperado.' . $e->getMessage());

    return Redirect::back()
        ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
}
    }

    public function verificarFirma($idtransaccion)
    {

        $token = $this->token();

       /* $transacciones = Storage::disk('local')->get("transaccion" . $idtransaccion . ".json");
        
        $json = json_decode($transacciones, true);

        $idArchivo = $json['idArchivo'];*/
        
        $certificado = Certificado::where('idtransaccion', $idtransaccion)->first();

        $idArchivo = $certificado->nombreArchivo;

        //$idArchivo = 'id de archivo';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://firmadigital.santacruz.gob.ar/firmar/v1/descargar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
                        "IdArchivo": "' . $idArchivo . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token . '',
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        Storage::disk('local')->put("$idArchivo.pdf", $response);

        $file = Storage::disk('local')->get("$idArchivo.pdf");

        $certificado->firmado = 1;
        $certificado->save();

        $solicitud = Solicitud_firmas::where('solicitud', $idtransaccion)->first();
        $solicitud->firmado = 1;
        $solicitud->save();




/*
        return (new Response($file, 200))
            ->header('Content-Type', 'application/pdf');*/

            return redirect()->route('gestionarSolicitudes')->with('message', 'El documentos fue firmado Correctamente');




    }

    public function descargarCertificadoAlta($id)
    {
        
        $file = Storage::disk('local')->get("$id.pdf");

        return response($file, 200)
            ->header('Content-type', 'application/pdf');

    }

    public function getCertificados($id)
    {

        try {

            $data = Certificado::where("id_proveedor",$id)            
            ->where("firmado", "1")
            ->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('descargarCertificadoAlta/' . $row->nombreArchivo);
                $url2 = url('descargarCertificadoInscripccion/' . $row->nombreArchivo);

                $actionBtn = ' <a href="' . "$url" . '" class="view btn btn-primary btn-sm" title="descargarPDF">
                <i class="fas fa-pencil-alt"></i></a>';
                    return $actionBtn;
                
            })
            ->rawColumns(['action'])
                ->make(true);

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    
    public function getSolicitud_firmas()
    {
        try {
           
            $data = Solicitud_firmas::
            join('proveedores', 'solicitud_firmas.id_proveedor', '=', 'proveedores.id_proveedor')
            ->select('proveedores.id_proveedor','proveedores.nombre_fantasia', 'proveedores.razon_social', 'proveedores.cuit', 'solicitud_firmas.solicitud')
            ->where("firmado", "0")
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('firmar/' . $row->solicitud);
                
                $actionBtn = ' <a href="' . "$url" . '" class="view btn btn-primary btn-sm" title="firmar">
                <i class="fas fa-pencil-alt"></i></a>';
                    return $actionBtn;
                
            })
            ->rawColumns(['action'])
            ->make(true);

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function crearHistorico($id,$nombreArchivo,$idTransaccion)
    {
        try{
            $proveedor = Proveedor::find($id);
            if($proveedor->dado_de_baja != 1){
    
                $this->asignarNroRupaeProveedor($proveedor);
    
    
            $idAlta = $proveedor->nro_rupae_proveedor;
            $persona = $proveedor->personas()->get();
    
            if ($persona->isEmpty()) {
                $persona = "";
    
            } else {
                $persona = $persona[0];
            }
    
            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')->first();
    
            $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')->first();
    
            $proveedor_localidad_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();
    
            $proveedor_actividad_id = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->first();
    
            if (empty($proveedor_actividad_id)) {
                $proveedor_tipo_actividad = "";
            } else {
                $proveedor_tipo_actividad = Tipo_actividad::where('id_tipo_actividad', $proveedor_actividad_id->id_tipo_actividad)->first();
            }
    
            $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
                ->first();
    
            $provinciaLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();
    
            if ($provinciaLegal->isEmpty()) {
                $provinciaLegal = "";
            } else {
                $provinciaLegal = $provinciaLegal[0]->id_provincia;
    
                $provinciaLegal = Provincia::where('id_provincia', $provinciaLegal)->first();
            }
    
            $proveedor_localidad_legal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->first();
    
            $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
                ->first();
    
            $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
                ->first();
    
            $provinciaReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();
    
            if ($provinciaReal->isEmpty()) {
                $provinciaReal = "";
            } else {
                $provinciaReal = $provinciaReal[0]->id_provincia;
    
                $provinciaReal = Provincia::where('id_provincia', $provinciaReal)->first();
            }
    
            $proveedor_email_real = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'real')
                ->first();
    
            if (empty($proveedor_actividad_id)) {
                $Actividad_economica = "";
            } else {
                $Actividad_economica = Actividad_economica::where('id_actividad_economica', $proveedor_actividad_id->id_tipo_actividad)->first();
                $Actividad_economica = $Actividad_economica->desc_actividad;
            }
    
            $proveedor_actividad_secundaria = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 2)->get();
            $actividades_Secundarias = "";
    
            foreach ($proveedor_actividad_secundaria as $actividad_secundaria) {
    
                $Actividad_economica2 = Actividad_economica::where('id_actividad_economica', $actividad_secundaria->id_tipo_actividad)->first();
    
                $actividades_Secundarias = $Actividad_economica2->cod_actividad . "," . $actividades_Secundarias;
            }
            $fecha_emision_certificado = Carbon::now();
            $jerarquias = Jerarquia_compre_local::all();
            $desc_jerarquia_compre_local = '';
            foreach ($jerarquias as $jerarquia) {
                if ($proveedor->valor_indice_rupae >= $jerarquia->valor_desde && $proveedor->valor_indice_rupae <= $jerarquia->valor_hasta) {
                    $desc_jerarquia_compre_local = $jerarquia->desc_jerarquia_compre_local;
                }
    
            }
            $proveedor->fecha_inscripcion = $fecha_emision_certificado;
            $proveedor->save();
            $certificado = Certificado::create([
                'nro_rupae_proveedor' => $proveedor->nro_rupae_proveedor,
                'fecha_inscripcion' => $proveedor->fecha_inscripcion,
                'razon_social' => $proveedor->razon_social,
                'cuit' => $proveedor->cuit,
                'nombre_fantasia' => $proveedor->nombre_fantasia,
                'calle_real' => isset($proveedor_domicilio_real->calle) ? $proveedor_domicilio_real->calle : null,
                'numero_real' => isset($proveedor_domicilio_real->numero) ? $proveedor_domicilio_real->numero : null,
                'nombre_localidad_real' => isset($proveedor_localidad_real->id_localidad) ? $proveedor_localidad_real->id_localidad : null,
                'nombre_provincia_real' => isset($provinciaReal->nombre_provincia) ? $provinciaReal->nombre_provincia : null,
                'nro_tel_real' => isset($proveedor_telefono_real->nro_tel) ? $proveedor_telefono_real->nro_tel : null,
                'email_real' => isset($proveedor_email_real->email) ? $proveedor_email_real->email : null,
                'nombre_localidad_legal' => isset($proveedor_localidad_legal->nombre_localidad) ? $proveedor_localidad_legal->nombre_localidad : null,
                'nombre_provincia_legal' => isset($provinciaLegal->nombre_provincia) ? $provinciaLegal->nombre_provincia : null,
                'calle_legal' => isset($proveedor_domicilio_legal->calle) ? $proveedor_domicilio_legal->calle : null,
                'numero_legal' => isset($proveedor_domicilio_legal->numero) ? $proveedor_domicilio_legal->numero : null,
                'nro_tel_legal' => isset($proveedor_telefono_legal->nro_tel) ? $proveedor_telefono_legal->nro_tel : null,
                'email_legal' => isset($proveedor_email_legal->email) ? $proveedor_email_legal->email : null,
                'nombre_representante_legal' => (isset($persona->nombre_persona) ? $persona->nombre_persona : null) . ' ' . (isset($persona->apellido_persona) ? $persona->apellido_persona : null),
                'dni_representante_legal' => isset($persona->dni_persona) ? $persona->dni_persona : null,
                'tipo_de_sociedad' => isset($proveedor->tipo_de_sociedad) ? $proveedor->tipo_de_sociedad : null,
                'situacion_iva' => isset($proveedor->situacion_iva) ? $proveedor->situacion_iva : null,
                'retencion' => isset($proveedor->retencion) ? $proveedor->retencion : null,
                'nro_ingresos_brutos' => isset($proveedor->nro_ingresos_brutos) ? $proveedor->nro_ingresos_brutos : null,
                'jurisdiccion' => isset($proveedor->jurisdiccion) ? $proveedor->jurisdiccion : null,
                'tipo_contribuyente' => isset($proveedor->tipo_contribuyente) ? $proveedor->tipo_contribuyente : null,
                'nro_habilitacion_municipal' => isset($proveedor->nro_habilitacion_municipal) ? $proveedor->nro_habilitacion_municipal : null,
                'nombre_localidad_habilit_municip' => isset($proveedor->localidad_habilitacion) ? $proveedor->localidad_habilitacion : null,
                'nro_inscripcion_personas_juridicas' => isset($proveedor->nro_inscripcion_personas_juridicas) ? $proveedor->nro_inscripcion_personas_juridicas : null,
                'provincia_inscrip_personas_jur' => isset($proveedor->provincia_inscrip_personas_jur) ? $proveedor->provincia_inscrip_personas_jur : null,
                'registro_publico_de_comercio' => isset($proveedor->registro_publico_de_comercio) ? $proveedor->registro_publico_de_comercio : null,
                'provincia_registro_publico' => isset($proveedor->provincia_registro_publico) ? $proveedor->provincia_registro_publico : null,
                'inspeccion_gral_justicia' => isset($proveedor->inspeccion_gral_justicia) ? $proveedor->inspeccion_gral_justicia : null,
                'provincia_inspeccion_justicia' => isset($proveedor->provincia_inspeccion_justicia) ? $proveedor->provincia_inspeccion_justicia : null,
                'desc_actividad_economica_princ' => isset($Actividad_economica) ? $Actividad_economica : null,
                'desc_actividad_economica_sec' => isset($actividades_Secundarias) ? $actividades_Secundarias : null,
                'porc_mo' => isset($proveedor->porc_mo) ? $proveedor->porc_mo : null, //Porcentaje de Mano de Obra en Santa Cruz
                'porc_facturacion' => $proveedor->porc_facturacion,
                'porc_gasto' => isset($proveedor->porc_gasto) ? $proveedor->porc_gasto : null,
                'antiguedad' => isset($proveedor->antiguedad) ? $proveedor->antiguedad : null,
                'dom_fiscal' => isset($proveedor->dom_fiscal) ? $proveedor->dom_fiscal : null,
                'valor_agregado' => isset($proveedor->valor_agregado) ? $proveedor->valor_agregado : null,
                'valor_indice_rupae' => isset($proveedor->valor_indice_rupae) ? $proveedor->valor_indice_rupae : null,
                'desc_jerarquia_compre_local' => isset($desc_jerarquia_compre_local) ? $desc_jerarquia_compre_local : null,
                'fecha_emision_certificado' => $fecha_emision_certificado,
                'nombreArchivo' => $nombreArchivo,
                'idTransaccion' => $idTransaccion,

            ]);
            $proveedor->certificados()->save($certificado);
            return 1;
        }
        else{
            return Redirect::back()
            ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);
    
        }
    } catch (\Exception$e) {
        Log::error('Error inesperado.' . $e->getMessage());
    
        return Redirect::back()
            ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
    }
    }

    public function SolicitudFirmar($id)
    {
        $solicitud = uniqid();

        $solicitud = Solicitud_firmas::create([
            
            'id_proveedor' => $id,
            'solicitud' => $solicitud,
        ]);
        $solicitud->save();
    }

}
