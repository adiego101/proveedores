<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Models\Tipo_actividad;
use App\Models\Proveedor_email;
use App\Models\Proveedor_telefono;
use App\Models\Actividad_economica;
use App\Models\Proveedor_domicilio;
use App\Models\Actividades_proveedores;

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

public function descargarRegistroAlta($id)
{
    $proveedor = Proveedor::find($id);

    $persona = $proveedor->personas()->get();
    $persona = $persona[0];

    $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')->first();

    $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')->first();

    $proveedor_localidad_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();

    $proveedor_actividad_id = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->first();

    $proveedor_tipo_actividad = Tipo_actividad::where('id_tipo_actividad', $proveedor_actividad_id->id_tipo_actividad)->first();

    $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
    ->first();

    $provinciaLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

    $provinciaLegal =  $provinciaLegal[0]->id_provincia;

    $provinciaLegal = Provincia::where('id_provincia', $provinciaLegal)->first();

    $proveedor_localidad_legal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->first();


    $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
        ->first();

    $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
        ->first();


    $provinciaReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

    $provinciaReal =  $provinciaReal[0]->id_provincia;

    $provinciaReal = Provincia::where('id_provincia', $provinciaReal)->first();

    $proveedor_email_real = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'real')
        ->first();



    $Actividad_economica = Actividad_economica::where('id_actividad_economica', $proveedor_actividad_id->id_tipo_actividad)->first();

    $proveedor_actividad_secundaria = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 2)->get();
    $actividades_Secundarias = "";

    foreach( $proveedor_actividad_secundaria as $actividad_secundaria){

        $Actividad_economica2 = Actividad_economica::where('id_actividad_economica', $actividad_secundaria->id_tipo_actividad)->first();

        $actividades_Secundarias = $Actividad_economica2->cod_actividad.",".$actividades_Secundarias;
    }

    $data = [
        'proveedor' => $proveedor,
        'titulo' => 'Certificado inscripción',
        'cuit' => $proveedor->cuit,
        'nombre_fantasia' => $proveedor->nombre_fantasia,
        'razon_social' => $proveedor->razon_social,
        'actividad_principal' => $Actividad_economica->desc_actividad, //FALTA RECUPERAR
        'actividad_secundaria' => $actividades_Secundarias,
        'calle_ruta_real' => $proveedor_domicilio_real->calle.' '.$proveedor_domicilio_real->numero,

        'telefono_real' =>  $proveedor_telefono_real->nro_tel,
        'localidad_real' => $proveedor_localidad_real->nombre_localidad,
        'provincia_real' => $provinciaReal->nombre_provincia,
        'email_real' => $proveedor_email_real->email,

        'calle_ruta_legal' => $proveedor_domicilio_legal->calle.' '.$proveedor_domicilio_legal->numero,
        'telefono_legal' =>  $proveedor_telefono_legal->nro_tel,
        'provincia_legal' => $provinciaLegal->nombre_provincia,
        'email_legal' => $proveedor_email_legal->email,
        'representante_legal' => $persona,

        'localidad_legal' => $proveedor_localidad_legal->nombre_localidad,
        'fecha_inscripcion' => $proveedor->created_at,

    ];


    return PDF::loadView('registroAlta', array('data'=> $data))
        ->stream('registro-alta.pdf');
}


public function descargarCertificadoInscripcion($id)
{
    $proveedor = Proveedor::find($id);

    $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')->first();

    $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')->first();

    $proveedor_localidad_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();

    $proveedor_actividad_id = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->first();

    $proveedor_tipo_actividad = Tipo_actividad::where('id_tipo_actividad', $proveedor_actividad_id->id_tipo_actividad)->first();

    $Actividad_economica = Actividad_economica::where('id_actividad_economica', $proveedor_actividad_id->id_tipo_actividad)->first();

    $proveedor_actividad_secundaria = Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 2)->get();
    $actividades_Secundarias = "";

    foreach( $proveedor_actividad_secundaria as $actividad_secundaria){

        $Actividad_economica2 = Actividad_economica::where('id_actividad_economica', $actividad_secundaria->id_tipo_actividad)->first();

        $actividades_Secundarias = $Actividad_economica2->cod_actividad.",".$actividades_Secundarias;
    }

    $data = [
        'titulo' => 'Certificado inscripción',
        'cuit' => $proveedor->cuit,
        'nombre_fantasia' => $proveedor->nombre_fantasia,
        'razon_social' => $proveedor->razon_social,
        'actividad_principal' => $Actividad_economica->desc_actividad, //FALTA RECUPERAR
        'actividad_secundaria' => $actividades_Secundarias,
        'calle_ruta' => $proveedor_domicilio_real->calle.' '.$proveedor_domicilio_real->numero,
        'telefono' =>  $proveedor_telefono_real->nro_tel,
        'fecha_inscripcion' => $proveedor->created_at,
        'localidad' => $proveedor_localidad_real->nombre_localidad

    ];

    return PDF::loadView('certificadoInscripcion', array('data'=> $data))
        ->stream('certificado-inscripcion.pdf');
}


}
