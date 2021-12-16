<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\Sucursal;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Models\Sucursal_email;
use App\Models\Proveedor_email;
use App\Models\Proveedor_seguro;
use App\Models\Proveedor_patente;
use App\Models\Sucursal_telefono;
use App\Models\Proveedor_telefono;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor_domicilio;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProveedoresController extends Controller
{


    //Carga Completa de Proveedor
    public function crear_registro(Request $request)
    {

        //try{
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

        //---------Contador de Telefono_Real----------

        $arraySize = count( $request->telefono_real);

        for($i=0; $i < $arraySize; $i++) {
        //---------Carga de Telefonos_Real----------

        $telefono_real = Proveedor_telefono::create([
            'nro_tel'=>$request->telefono_real[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            //'cod_area_tel' =>,
            //'tipo_medio'=>,
            //'desc_telefono'=>,
            'tipo_telefono'=>'real',
            //'nro_orden_telefono'=>,
            ]);
            $telefono_real->save();
        }

        //---------Contador de Email_Real----------

        $arraySize = count( $request->email_real);

        for($i=0; $i < $arraySize; $i++) {
        //---------Carga de Email_Real----------

        $email_real = Proveedor_email::create([
            'email'=>$request->email_real[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'tipo_email'=>'real',
            ]);
            $email_real->save();
        }

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
        //---------Contador de Telefono_Legal----------

        $arraySize = count( $request->telefono_legal);

        //---------Carga de Telefonos_Legal----------

        for($i=0; $i < $arraySize; $i++) {

        $telefono_legal = Proveedor_telefono::create([
            'nro_tel'=>$request->telefono_legal[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            //'cod_area_tel' =>,
            //'tipo_medio'=>,
            //'desc_telefono'=>,
            'tipo_telefono'=>'legal',
            //'nro_orden_telefono'=>,
            ]);
            $telefono_legal->save();
        }
        //---------Contador de Email_Legal----------

        $arraySize = count( $request->email_legal);

        for($i=0; $i < $arraySize; $i++) {
        //---------Carga de Email_legal----------

        $email_legal = Proveedor_email::create([
            'email'=>$request->email_legal[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'tipo_email'=>'legal',
            ]);
            $email_legal->save();
        }

        $Representante_legal = Persona::create([
            'dni_persona'=>$request->dni_legal,
            //'cuil_persona'=>$proveedores_rupae->cuil_persona,
            'nombre_persona'=>$request->representante_legal,
            //'apellido_persona'=>$proveedores_rupae->apellido_persona,
            //'genero_persona'=>$proveedores_rupae->genero_persona,
            ]);
        $Representante_legal->save();

        $proveedores_rupae->personas()->attach($Representante_legal);





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
        //---------Contador de Telefono_Fiscal----------

        $arraySize = count( $request->telefono_fiscal);

        //---------Carga de Telefonos_Fiscal----------

        for($i=0; $i < $arraySize; $i++) {
        $telefono_fiscal = Proveedor_telefono::create([
            'nro_tel'=>$request->telefono_fiscal[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            //'cod_area_tel' =>,
            //'tipo_medio'=>,
            //'desc_telefono'=>,
            'tipo_telefono'=>'fiscal',
            //'nro_orden_telefono'=>,
            ]);
            $telefono_fiscal->save();

        }

        //---------Contador de Email_fiscal----------

        $arraySize = count( $request->email_legal);

        for($i=0; $i < $arraySize; $i++) {
        //---------Carga de Email_fiscal----------

        $email_fiscal = Proveedor_email::create([
            'email'=>$request->email_fiscal[$i] ,
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'tipo_email'=>'fiscal',
            ]);
            $email_fiscal->save();
        }

        //------------------------------------------SUCURSALES--------------------------------------------------------

        //---------Contador de sucursales----------
        if(isset($request->calles)){

        $arraySize = count( $request->calles);

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
            if(isset($request->correos_electronicos)){
            $sucursal_email = new Sucursal_email();
            $sucursal_email->id_sucursal = $sucursal->id_sucursal;
            $sucursal_email->email = $request->correos_electronicos[$i];
            $sucursal_email ->save();
        }
            //----------------Carga de telefono Sucursal---------------
            if(isset($request->Telefonos_sucursales)){

            $sucursal_telefono = new Sucursal_telefono();
            $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
            $sucursal_telefono->nro_tel = $request->Telefonos_sucursales[$i];
            $sucursal_telefono->save();
            }
            echo($sucursal->toJson());
        }
            }
        //---------Contador de Patentes----------
        if(isset($request->marcas)){

        $arraySize = count( $request->marcas);
        var_dump($arraySize );

        //---------Carga de Patentes----------

        for($i=0; $i < $arraySize; $i++) {
        $Proveedor_patente = Proveedor_patente::create([
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'dominio'=>$request->dominios[$i] ,
            'marca'=>$request->marcas[$i] ,
            'modelo'=>$request->modelos[$i] ,
            'inscripto_en'=>$request->inscriptos[$i] ,

            ]);

        $Proveedor_patente->save();
        }
        }
        //---------Contador de Polizas----------
        if(isset($request->polizas)){

        $arraySize = count( $request->polizas);
        var_dump($arraySize );

        //---------Carga de Polizas----------

        for($i=0; $i < $arraySize; $i++) {
        $Proveedor_seguro = Proveedor_seguro::create([
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'poliza'=>$request->polizas[$i],
            'agencia'=>$request->agencias[$i],
            'asegurado'=>$request->asegurados[$i],
            'vigencia_hasta'=>$request->vigentes[$i],

            ]);
        $Proveedor_seguro->save();
        }
    }

        //---------Contador de Pagos----------
        if(isset($request->importes)){

        $arraySize = count( $request->importes);
        var_dump($arraySize );

        //---------Carga de Pagos----------
        for($i=0; $i < $arraySize; $i++) {
        $Pago = Pago::create([
            'id_proveedor'=>$proveedores_rupae->id_proveedor,
            'fecha'=>$request->fechas[$i],
            'importe'=>$request->importes[$i],
            'observaciones'=>$request->observaciones[$i],

            ]);
        $Pago->save();
        }
    }


            return redirect()->back()->with('message','Registro Creado Correctamente');
        //}
        /*catch (\Exception $e)
        {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error al realizar la carga, la operación no pudo completarse']);
        }*/

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
                    $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaRegistro('.$row->id_proveedor.');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
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


    /*public function dar_baja_id($id)
    {

        $proveedores_rupae = Proveedor::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }*/


    public function dar_baja_id(Request $request)
    {


        $proveedores_rupae = Proveedor::find($request->id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();


    }

    public function getLocalidades($provincia, Request $request)
    {
        //obtenemos el id de la provincia
        $provinciaid = DB::table('provincias')->where('nombre_provincia', $provincia)->first();
        
        //Obtenemos las localidades de la provincia seleccionada
        $localidades = Localidad::where('id_provincia', $provinciaid->id_provincia)->orderby('nombre_localidad','asc')->get();

        //Calculamos el tamaño de las localidades
        $max = sizeof($localidades);
                
        //var_dump(json_decode(json_encode($localidades[0]["nombre_localidad"])));

        $select = '';

        for($i = 0; $i < $max;$i++)
        {
            $select = $select.'<option value='.$localidades[$i]["nombre_localidad"].'>'.$localidades[$i]["nombre_localidad"].'</option>';
        }

        return $select;
    }


}
