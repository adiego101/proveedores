<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use PDF;

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

    $data = [
        'titulo' => 'Registro alta',

    ];

    return PDF::loadView('registroAlta', array('data'=> $data))
        ->stream('registro-alta.pdf');
}


public function descargarCertificadoInscripcion($id)
{
    $proveedor = Proveedor::find($id);

    $data = [
        'titulo' => 'Certificado inscripción',
        'cuit' => $proveedor->cuit,
        'nombre_fantasia' => $proveedor->nombre_fantasia,
        'razon_social' => $proveedor->razon_social,
        'actividad_principal' => 'Desarrollo',
        'actividad_secundaria' => 'Mantenimiento',
        'calle_ruta' => 'calle 1',
        'telefono' => '2966 - 665544',
        'fecha_inscripcion' => $proveedor->created_at,
        'localidad' => 'Rio Gallegos'

    ];

    return PDF::loadView('certificadoInscripcion', array('data'=> $data))
        ->stream('certificado-inscripcion.pdf');
}


}
