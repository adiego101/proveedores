<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Sucursal;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor_domicilio;

class ProveedoresController extends Controller
{


    //Funcion para dar de alta un nuevo registro en la BD
    public function crear_registro(Request $request)
    {
        //-------------------Carga Proveedor-------------------

        $proveedores_rupae = new Proveedor($request->all());
        $proveedores_rupae->save();

        //----------------------------------Carga Domicilio Real---------------------------------------------

        $domicilio_real = Proveedor_domicilio::create([
                                                        'tipo_domicilio'=>'real',
                                                        //'nro_orden_domicilio',
                                                        'calle'=>$request->input('calle_real'),
                                                        'id_proveedor'=>$proveedores_rupae->id_proveedor,
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
        $domicilio_real->save();

        //----------------------------------Carga Domicilio Legal---------------------------------------------

        $domicilio_legal = Proveedor_domicilio::create([
                                                    'tipo_domicilio'=>'legal',
                                                    'id_proveedor'=>$proveedores_rupae->id_proveedor,

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
        $domicilio_legal->save();

        //----------------------------------Carga Domicilio Fiscal---------------------------------------------

        $domicilio_fiscal = Proveedor_domicilio::create([
                                                    'tipo_domicilio'=>'fiscal',
                                                    'id_proveedor'=>$proveedores_rupae->id_proveedor,
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
        $domicilio_fiscal->save();


        //---------Contador de sucursales----------

        $arraySize = count( $request->calles);
        var_dump($arraySize );

        for($i=0; $i < $arraySize; $i++) {

            //----------------Carga de Sucursal---------------

            $sucursal = new Sucursal();
            $sucursal->id_proveedor = $proveedores_rupae->id_proveedor;
            $sucursal->calle = $request->calles[$i];
            $sucursal->barrio = $request->barrios[$i];
            $sucursal->numero = $request->numeros[$i];
            $sucursal->entre_calles = $request->entreCalles[$i];
            $sucursal->dpto = $request->dptos[$i];

            $sucursal->save();

            //----------------Carga de email Sucursal---------------

            $sucursal_email = new Sucursal_email();
            $sucursal_email->id_sucursal = $sucursal->id_sucursal;
            $sucursal_email->email = $request->email[$i];
            $sucursal_email ->save();

            //----------------Carga de telefono Sucursal---------------
            $sucursal_telefono = new Sucursal_telefono();
            $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
            $sucursal_telefono->nro_tel = $request->Telefonos_sucursales[$i];
            $sucursal_telefono->save();

            echo($sucursal->toJson());
        }


        return redirect()->back();

    }



    //onclick="bajaRegistro('.$row->id.');"
    /*
    Funcion que devuelve un listado de proveedores almacenados en la BD (Datatable)
    junto a los botones para editar, ver y dar de baja un registro
    */
    public function getProveedores(Request $request)
    {
        if ($request->ajax()) {
            $data = Proveedor::latest()->where('dado_de_baja', 0)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm">Editar</a> <a onclick="verRegistro();" class="view btn btn-success btn-sm">Ver</a> <a href="bajaid/' . "$row->id_proveedor" . '" class="delete btn btn-danger btn-sm">Dar de baja</a>';
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



    /*
    En esta función obtenemos cada uno de los datos de las distintas tablas, de un proveedor.
    */
    public function obtenerProveedorRupaeId($id)
    {
        $proveedor = DB::table('proveedores')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_email = DB::table('proveedores_emails')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_domicilio = DB::table('proveedores_domicilios')
            ->where('id_proveedor', $id)
            ->first();

        return view('editarRegistro', ['proveedor' => $proveedor,
            'proveedor_email' => $proveedor_email,
            'proveedor_domicilio' => $proveedor_domicilio]);
    }



    public function editarProveedor($id, Request $request)
    {
        $proveedor = DB::table('proveedores')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_email = DB::table('proveedores_emails')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_domicilio = DB::table('proveedores_domicilios')
            ->where('id_proveedor', $id)
            ->first();

        $proveedores_rupae = Proveedor::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae = $proveedores_rupae->fill($request->all());
        $proveedores_rupae->save();
        return redirect()->back();

    }



    public function dar_baja(Request $request)
    {

        $proveedores_rupae = Proveedor::find($request->id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }


    public function dar_baja_id($id)
    {

        $proveedores_rupae = Proveedor::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }
}
