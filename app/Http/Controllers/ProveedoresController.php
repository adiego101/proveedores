<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor_rupae;
use DataTables;

class ProveedoresController extends Controller
{
    //
    public function todos(Request $request)
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
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Editar</a> <a href="javascript:void(0)" class="view btn btn-warning btn-sm">Ver</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Eliminar</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
