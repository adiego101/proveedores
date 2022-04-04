<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Provincia;
use App\Models\Certificado;
use Illuminate\Http\Request;
use App\Models\Tipo_actividad;
use App\Models\Proveedor_email;
use App\Models\Proveedor_telefono;
use App\Models\Actividad_economica;
use App\Models\Proveedor_domicilio;
use App\Models\Jerarquia_compre_local;
use App\Models\Actividades_proveedores;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class RupaeController extends Controller
{

    protected $proveedores_rupae;

    public function __construct(Proveedor $proveedores_rupae)
    {
        $this->proveedores_rupae = $proveedores_rupae;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores_rupae = $this->proveedores_rupae->obtenerProveedoresRupae();
        return view('proveedores.listado', ['proveedores_rupae' => $proveedores_rupae]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedores_rupae = new Proveedor($request->all());
        $proveedores_rupae->save();
        return redirect()->action([RupaeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedores_rupae = $this->proveedores_rupae->obtenerProveedorRupaeId($id);
        return view('proveedores.ver', ['proveedores_rupae' => $proveedores_rupae]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedores_rupae = $this->proveedores_rupae->obtenerProveedorRupaeId($id);
        return view('proveedores_rupae.editar', ['proveedores_rupae' => $proveedores_rupae]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedores_rupae = Proveedor::find($id);
        $proveedores_rupae->fill($request->all());
        $proveedores_rupae->save();
        return redirect()->action([RupaeController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedores_rupae = Proveedor::find($id);
        $proveedores_rupae->delete();
        return redirect()->action([RupaeController::class, 'index']);
    }

//Prueba generacion PDF
    public function generarRegistroAlta($id, $idCertificado)
    {
        $proveedor = Proveedor::find($id);

    if($proveedor->dado_de_baja != 1){

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
            $Actividad_economica = $Actividad_economica->desc_actividad;
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

        $fecha_emision_certificado = Carbon::now();
        $data = [
            'proveedor' => $proveedor,
            'titulo' => 'Certificado inscripción',
            'cuit' => $proveedor->cuit,
            'nombre_fantasia' => $proveedor->nombre_fantasia,
            'razon_social' => $proveedor->razon_social,
            'actividad_principal' => $Actividad_economica,
            'actividad_secundaria' => $actividades_Secundarias,
            'calle_ruta_real' => $proveedor_domicilio_real->calle . ' ' . $proveedor_domicilio_real->numero,

            'telefono_real' => isset($proveedor_telefono_real->nro_tel) ? $proveedor_telefono_real->nro_tel : '',
            'localidad_real' => isset($proveedor_localidad_real->nombre_localidad) ? $proveedor_localidad_real->nombre_localidad : '',
            'provincia_real' => isset($provinciaReal->nombre_provincia) ? $provinciaReal->nombre_provincia : '',
            'email_real' => isset($proveedor_email_real->email) ? $proveedor_email_real->email : '',
            'cod_tel_real' => isset($proveedor_telefono_real->cod_area_tel) ? $proveedor_telefono_real->cod_area_tel : null,

            'calle_ruta_legal' => $proveedor_domicilio_legal->calle . ' ' . $proveedor_domicilio_legal->numero,
            'telefono_legal' => isset($proveedor_telefono_legal->nro_tel) ? $proveedor_telefono_legal->nro_tel : '',
            'provincia_legal' => isset($provinciaLegal->nombre_provincia) ? $provinciaLegal->nombre_provincia : '',
            'email_legal' => isset($proveedor_email_legal->email) ? $proveedor_email_legal->email : '',
            'representante_legal' => $persona,
            'cod_tel_legal' => isset($proveedor_telefono_legal->cod_area_tel) ? $proveedor_telefono_legal->cod_area_tel : null,

            'localidad_legal' => isset($proveedor_localidad_legal->nombre_localidad) ? $proveedor_localidad_legal->nombre_localidad : '',
            'fecha_inscripcion' => isset($proveedor->fecha_inscripcion) ? $proveedor->fecha_inscripcion : '',
            'fecha_emision_certificado' => $fecha_emision_certificado->format("d/m/Y H:i:s"),
        ];

        /*
        return PDF::loadView('registroAlta', array('data'=> $data))
        ->stream('registro-alta.pdf');*/
        $dompdf = PDF::loadView('registroAlta', array('data' => $data));
        // return storage_path('app/public/');
        $dompdf->save(storage_path('app/public/') . 'registro-alta_' . $idCertificado . '.pdf');
        //return $dompdf->stream('registro-alta_'.$idAlta.'.pdf');
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }
    }

    public function descargarRegistroAlta($id)
    {
        $proveedor = Proveedor::find($id);
        if($proveedor->dado_de_baja != 1){


        $certificado = Certificado::where('id_proveedor', $id)->exists();

        if (!$certificado) {
            $this->guardarHistorico($id);

            $certificado = Certificado::where('id_proveedor', $id)->get()->last();

            $this->generarCertificadoInscripcion($id, $certificado->id_certificado);
            $this->generarRegistroAlta($id, $certificado->id_certificado);

            $file_name = "registro-alta_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');
        } else {

            $certificado = Certificado::where('id_proveedor', $id)->get()->last();
            $file_name = "registro-alta_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');

            return $certificado->id_certificado;
        }
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }
    }

    public function nuevoRegistroAlta($id)
    {
        $proveedor = Proveedor::find($id);
        if($proveedor->dado_de_baja != 1){


            $certificado = Certificado::where('id_proveedor', $id)->exists();

            $this->guardarHistorico($id);

            $certificado = Certificado::where('id_proveedor', $id)->get()->last();

            $this->generarCertificadoInscripcion($id, $certificado->id_certificado);
            $this->generarRegistroAlta($id, $certificado->id_certificado);

            $file_name = "registro-alta_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');
        }
        else{
            return Redirect::back()
            ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

        }

    }

    public function generarHistoricoCertificado($id)
    {
        $proveedor = Proveedor::find($id);
        if($proveedor->dado_de_baja != 1){

        // crea una ID única con un número aleatorio como prefijo, más seguro que un prefijo estático uniqid (rand (), true)
        //$idInscripcion = uniqid (rand ());

        //return $idInscripcion;

            $this->asignarNroRupaeProveedor($proveedor);


        $idAlta = $proveedor->nro_rupae_proveedor;

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')->first();

        $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')->first();

        $proveedor_localidad_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();

        $proveedor_actividad_id = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->first();
        if (!$proveedor_actividad_id) {
            $proveedor_tipo_actividad = "";
            $Actividad_economica = "";

        } else {
            $proveedor_tipo_actividad = Tipo_actividad::where('id_tipo_actividad', $proveedor_actividad_id->id_tipo_actividad)->first();
            $Actividad_economica = Actividad_economica::where('id_actividad_economica', $proveedor_actividad_id->id_tipo_actividad)->first();


        }
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }

    }

    public function generarCertificadoInscripcion($id, $idCertificado)
    {

        $proveedor = Proveedor::find($id);
        if($proveedor->dado_de_baja != 1){

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
        $dompdf->save(storage_path('app/public/') . 'certificado-inscripcion_' . $idCertificado . '.pdf');

        //return $dompdf->stream('certificado-inscripcion_'.$idAlta.'.pdf');

        //return PDF::loadFile(public_path().'/certificado-inscripcion.pdf')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

        //return $content;
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }
    }

    public function descargarCertificadoInscripcion($id)
    {
        $proveedor = Proveedor::find($id);

        if($proveedor->dado_de_baja != 1){


        $certificado = Certificado::where('id_proveedor', $id)->exists();

        if (!$certificado) {
            $this->guardarHistorico($id);

            $certificado = Certificado::where('id_proveedor', $id)->get()->last();

            $this->generarCertificadoInscripcion($id, $certificado->id_certificado);
            $this->generarRegistroAlta($id, $certificado->id_certificado);
            $file_name = "certificado-inscripcion_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');
        } else {

            $certificado = Certificado::where('id_proveedor', $id)->get()->last();
            $file_name = "certificado-inscripcion_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');

            return $certificado->id_certificado;
        }
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }

    }

    public function nuevoCertificadoInscripcion($id)
    {
        $proveedor = Proveedor::find($id);

        if($proveedor->dado_de_baja != 1){
            $certificado = Certificado::where('id_proveedor', $id)->exists();
            $this->guardarHistorico($id);
            $certificado = Certificado::where('id_proveedor', $id)->get()->last();
            $this->generarCertificadoInscripcion($id, $certificado->id_certificado);
            $this->generarRegistroAlta($id, $certificado->id_certificado);
            $file_name = "certificado-inscripcion_$certificado->id_certificado.pdf";

            $file = Storage::disk('public')->get($file_name);

            return response($file, 200)
                ->header('Content-type', 'application/pdf');
            }
            else{
                return Redirect::back()
                ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

            }
    }

    public function asignarNroRupaeProveedor($proveedor)
    {
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
    }

    public function guardarHistorico($id)
    {
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
        ]);
        $proveedor->certificados()->save($certificado);
    }
    else{
        return Redirect::back()
        ->withErrors(['El registro se encuentra dado de baja, no se puede descargar certificado']);

    }
    }


}
