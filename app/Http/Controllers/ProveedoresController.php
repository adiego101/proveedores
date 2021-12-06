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
        
        $domicilio_real = Proveedor_domicilio::create([
                                                        'tipo_domicilio'=>'real',
                                                        //'nro_orden_domicilio',
                                                        'calle'=>$request->input('calle_real'),
                                                        'numero'=>$request->input('numero_real'),
                                                        'lote'=>$request->input('lote_real'),
                                                        'entre_calles'=>$request->input('entreCalles_real'),
                                                        'monoblock'=>$request->input('monoblock_real'),
                                                        'dpto'=>$request->input('dpto_real'),
                                                        'puerta'=>$request->input('puerta_real'),
                                                        'oficina'=>$request->input('oficina_real'),
                                                        'manzana'=>$request->input('manzana_real'),
                                                        'barrio'=>$request->input('barrio_real'),
                                                        'codigo_postal'=>$request->input('cp_real'),
                                                    ]);
        $proveedores_rupae->domicilios()->attach($domicilio_real);
        $domicilio_legal = Proveedor_domicilio::create([
                                                    'tipo_domicilio'=>'legal',
                                                    //'nro_orden_domicilio',
                                                    'calle'=>$request->input('calle_legal'),
                                                    'numero'=>$request->input('numero_legal'),
                                                    'lote'=>$request->input('lote_legal'),
                                                    'entre_calles'=>$request->input('entreCalles_legal'),
                                                    'monoblock'=>$request->input('monoblock_legal'),
                                                    'dpto'=>$request->input('dpto_legal'),
                                                    'puerta'=>$request->input('puerta_legal'),
                                                    'oficina'=>$request->input('oficina_legal'),
                                                    'manzana'=>$request->input('manzana_legal'),
                                                    'barrio'=>$request->input('barrio_legal'),
                                                    'codigo_postal'=>$request->input('cp_legal'),
                                                ]);
        $proveedores_rupae->domicilios()->attach($domicilio_legal);
        $domicilio_fiscal = Proveedor_domicilio::create([
                                                    'tipo_domicilio'=>'fiscal',
                                                    //'nro_orden_domicilio',
                                                    'calle'=>$request->input('calle_fiscal'),
                                                    'numero'=>$request->input('numero_fiscal'),
                                                    'lote'=>$request->input('lote_fiscal'),
                                                    'entre_calles'=>$request->input('entreCalles_fiscal'),
                                                    'monoblock'=>$request->input('monoblock_fiscal'),
                                                    'dpto'=>$request->input('dpto_fiscal'),
                                                    'puerta'=>$request->input('puerta_fiscal'),
                                                    'oficina'=>$request->input('oficina_fiscal'),
                                                    'manzana'=>$request->input('manzana_fiscal'),
                                                    'barrio'=>$request->input('barrio_fiscal'),
                                                    'codigo_postal'=>$request->input('cp_fiscal'),
                                                ]);
        $proveedores_rupae->domicilios()->attach($domicilio_fiscal);
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
