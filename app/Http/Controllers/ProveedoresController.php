<?php

namespace App\Http\Controllers;

use App\Models\Proveedor_domicilio;
use App\Models\Proveedor_rupae;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedoresController extends Controller
{

    
    //Funcion para dar de alta un nuevo registro en la BD
    public function crear_registro(Request $request)
    {

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

        $arraySize = count( $request->calles);
        var_dump($arraySize );

        for($i=0; $i < $arraySize; $i++) {

            $proveedores_domicilio = new Proveedor_domicilio();
            $proveedores_domicilio->id_proveedores_rupae = $proveedores_rupae->id;
            $proveedores_domicilio->tipo_domicilio = "Sucursal";
            $proveedores_domicilio->calle = $request->calles[$i];
            $proveedores_domicilio->barrio = $request->barrios[$i];
            $proveedores_domicilio->numero = $request->numeros[$i];
            $proveedores_domicilio->entre_calles = $request->entreCalles[$i];
            $proveedores_domicilio->dpto = $request->dptos[$i];
            $proveedores_domicilio->email = $request->barrios[$i];
            $proveedores_domicilio->telefono = $request->Telefonos_sucursales[$i];
            $proveedores_domicilio->save();
            /*echo($proveedores_domicilio->toJson());*/
        }

        /*$proveedores_domicilio->save();
        return redirect()->back();*/

        //$domicilio->numero = $request->numeros[$i];

        //var_dump($request->calles[$i]);
        //$domicilio->telefono = $request->telefonos[$i];

        //$domicilio->tipo_domicilio = "Sucursal";

    }

    

    //onclick="bajaRegistro('.$row->id.');"
    /*
    Funcion que devuelve un listado de proveedores almacenados en la BD (Datatable)
    junto a los botones para editar, ver y dar de baja un registro
    */
    public function getProveedores(Request $request)
    {
        if ($request->ajax()) {
            $data = Proveedor_rupae::latest()->where('dado_de_baja', 0)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="modificarRegistro/' . "$row->id" . '" class="edit btn btn-warning btn-sm">Editar</a> <a onclick="verRegistro();" class="view btn btn-success btn-sm">Ver</a> <a href="bajaid/' . "$row->id" . '" class="delete btn btn-danger btn-sm">Dar de baja</a>';
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



    public function editarProveedor($id, Request $request)
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

        $proveedores_rupae = Proveedor_rupae::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae = $proveedores_rupae->fill($request->all());
        $proveedores_rupae->save();
        return redirect()->back();

    }



    public function dar_baja(Request $request)
    {

        $proveedores_rupae = Proveedor_rupae::find($request->id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }


    public function dar_baja_id($id)
    {

        $proveedores_rupae = Proveedor_rupae::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }
}
