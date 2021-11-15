<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor_rupae;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProveedoresController extends Controller
{
    //
    public function crear_registro(Request $request)
    {
        /*
        'puestos_trabajo_Sta_Cruz',
                            'cant_administrativos',
                            'periodo_de_contratacion',
                            'cant_operarios',
                            'periodo_contratacion1',
                            'cant_personal_vta',
                            'periodo_contratacion2',
                            'cant_empleados_domicilio_sta_cruz',
                            'masa_salarial_bruta',*/

        $proveedores_rupae = new Proveedor_rupae($request->all());
        $proveedores_rupae->save();
        return redirect()->back();
/*
        var_dump( $request->prov_estado );
        var_dump( $request->prov_minero );
        var_dump( $request->prov_petrolero );

        var_dump( $request->prov_provincial );
*/

    }


    public function getProveedores(Request $request)
    {
        if ($request->ajax()) {
            $data = Proveedor_rupae::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="modificarRegistro/'."$row->id".'" class="edit btn btn-success btn-sm">Editar</a> <a onclick="verRegistro();" class="view btn btn-warning btn-sm">Ver</a> <a onclick="eliminarRegistro();" class="delete btn btn-danger btn-sm">Eliminar</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /*public function obtenerDatosProveedor($id){
        $proveedores_rupae = new Proveedor_rupae();
        $datos = $proveedores_rupae->obtenerProveedorRupaeId($id);
        return $datos;
    }*/

    /*En esta función obtenemos cada uno de los datos de las distintas tablas.
    Pero debemos validar que los datos de las demas tablas no sean nulos ya que dan error*/
    public function obtenerProveedorRupaeId($id)
    {
        $proveedor = DB::table('proveedores_rupae')
        ->where('id', $id)
        ->first();

        $proveedor_email = DB::table('proveedores_emails')
        ->where('id_proveedores_rupae', $id)
        ->first();


        $proveedor_domicilio = DB::table('proveedores_domicilios')
        ->where('id_proveedores_rupae', $id)
        ->first();

        return view('editarRegistro', ['proveedor' => $proveedor,
                                        'proveedor_email' => $proveedor_email,
                                        'proveedor_domicilio' => $proveedor_domicilio]);
    }

    public function editarProveedor($id)
    {
        $proveedor = DB::table('proveedores_rupae')
        ->where('id_proveedores_rupae', $id)
        ->first();

        $proveedor_email = DB::table('proveedores_emails')
        ->where('id_proveedores_rupae', $id)
        ->first();


        $proveedor_domicilio = DB::table('proveedores_domicilios')
        ->where('id_proveedores_rupae', $id)
        ->first();

        return view('editarRegistro', ['proveedor' => $proveedor,
                                        'proveedor_email' => $proveedor_email,
                                        'proveedor_domicilio' => $proveedor_domicilio]);
    }
}
