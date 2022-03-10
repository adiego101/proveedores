<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Models\Proveedor_sede;
use App\Models\Sucursal_email;
use App\Models\Tipo_actividad;
use App\Models\Proveedor_email;
use App\Models\Proveedor_seguro;
use App\Models\Proveedor_patente;
use App\Models\Sucursal_telefono;
use App\Models\Proveedor_telefono;
use Illuminate\Support\Facades\DB;
use App\Models\Actividad_economica;
use App\Models\Proveedor_domicilio;
use App\Models\Jerarquia_compre_local;
use App\Models\Actividades_proveedores;
use App\Models\Ponderacion_compre_local;
use Illuminate\Support\Facades\Redirect;
use App\Models\Proveedores_tipos_proveedores;
use App\Http\Controllers\ProveedoresController;

use Illuminate\Support\Facades\Log;

class ProveedoresController extends Controller
{

    public function idLocalidad($nombre_localidad)
    {
        $id_localidad = Localidad::where('nombre_localidad', $nombre_localidad)->get();
        $id_localidad = $id_localidad[0]->id_localidad;
        return $id_localidad;

    }

    public function idtipos_actividades($nombre_tipos_actividades)
    {
        $id_tipos_actividades = Tipo_actividad::where('desc_tipo_actividad', $nombre_tipos_actividades)->get();
        $id_tipos_actividades = $id_tipos_actividades[0]->id_tipo_actividad;
        return $id_tipos_actividades;

    }

    public function idActividad_economica($nombre_actividad)
    {
        $id_Actividad_economica = Actividad_economica::where('desc_actividad', $nombre_actividad)->get();
        $id_Actividad_economica = $id_Actividad_economica[0]->id_actividad_economica;
        return $id_Actividad_economica;

    }

    public function crear_registro_cuit(Request $request)
    {

        //try{
        $cuit = Proveedor::where('cuit', $request->cuit)->exists();
        $dado_de_baja = Proveedor::where('cuit', $request->cuit)->where('dado_de_baja', '0')->get();
        //return $dado_de_baja->isEmpty();
        //return empty($dado_de_baja);
        //return $cuit;
        if (!$cuit /*|| $dado_de_baja->isEmpty()*/) {
            return redirect()->route('nuevoRegistro');

        }
        else{

            $proveedor = Proveedor::where('cuit', $request->cuit)->first();

            return redirect()->route('modificarRegistro',['id' =>$proveedor->id_proveedor ]);

        }
    }

    //Carga Completa de Proveedor
    public function crear_registro(Request $request)
    {

        //try{
        $cuit = Proveedor::where('cuit', $request->cuit)->exists();
        $dado_de_baja = Proveedor::where('cuit', $request->cuit)->where('dado_de_baja', '0')->get();
        //return $dado_de_baja->isEmpty();
        //return empty($dado_de_baja);
        //return $cuit;
        if (!$cuit /*|| $dado_de_baja->isEmpty()*/) {

            //$id_tamanio_empresa = $request->id_tamanio_empresa;

            //-------------------Carga Proveedor-------------------
            //return $request->input('retencion');
            $proveedores_rupae = new Proveedor($request->all());
            //$proveedores_rupae->id_tamanio_empresa = $id_tamanio_empresa;

            $proveedores_rupae->save();

            //return "Fin";

            //---------Tipo de Proveedor----------
            if (isset($request->prov_provincial)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'id_tipo_proveedor' => '4',
                ]);
                $Proveedores_tipos_proveedores->save();
            }

            if (isset($request->prov_estado)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'id_tipo_proveedor' => '1',
                ]);

                $Proveedores_tipos_proveedores->save();}
            if (isset($request->prov_minero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'id_tipo_proveedor' => '2',
                ]);
                $Proveedores_tipos_proveedores->save();}

            if (isset($request->prov_petrolero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'id_tipo_proveedor' => '3',
                ]);
                $Proveedores_tipos_proveedores->save();}

            //----------------------------------Carga Domicilio Real---------------------------------------------

            $domicilio_real = Proveedor_domicilio::create([
                'tipo_domicilio' => 'real',
                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_real')),
                'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                'numero' => $request->input('numero_real'),
                'dpto' => htmlspecialchars($request->input('dpto_real')),
                'puerta' => htmlspecialchars($request->input('puerta_real')),
                'lote' => htmlspecialchars($request->input('lote_real')),
                'manzana' => htmlspecialchars($request->input('manzana_real')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_real')),
                'oficina' => htmlspecialchars($request->input('oficina_real')),
                'monoblock' => htmlspecialchars($request->input('monoblock_real')),
                'barrio' => htmlspecialchars($request->input('barrio_real')),
                'id_localidad' => $request->input('localidad_real'),
                'codigo_postal' => htmlspecialchars($request->input('cp_real')),
            ]);
            $domicilio_real->save();

            //---------Contador de Telefono_Real----------

            $arraySize = count($request->telefono_real);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Telefonos_Real----------

                $telefono_real = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_real[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'real',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_real->save();
            }

            //---------Contador de Email_Real----------

            $arraySize = count($request->email_real);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_Real----------

                $email_real = Proveedor_email::create([
                    'email' => $request->email_real[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    'tipo_email' => 'real',
                ]);
                $email_real->save();
            }

            //----------------------------------Carga Domicilio Legal---------------------------------------------

            $domicilio_legal = Proveedor_domicilio::create([
                'tipo_domicilio' => 'legal',
                'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),

                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_legal')),
                'numero' => $request->input('numero_legal'),
                'lote' => htmlspecialchars($request->input('lote_legal')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_legal')),
                'monoblock' => htmlspecialchars($request->input('monoblock_legal')),
                'dpto' => htmlspecialchars($request->input('dpto_legal')),
                'puerta' => htmlspecialchars($request->input('puerta_legal')),
                'oficina' => htmlspecialchars($request->input('oficina_legal')),
                'manzana' => htmlspecialchars($request->input('manzana_legal')),
                'barrio' => htmlspecialchars($request->input('barrio_legal')),
                'codigo_postal' => htmlspecialchars($request->input('cp_legal')),
                'id_localidad' => $request->input('localidad_legal'),

            ]);
            $domicilio_legal->save();
            //---------Contador de Telefono_Legal----------

            $arraySize = count($request->telefono_legal);

            //---------Carga de Telefonos_Legal----------

            for ($i = 0; $i < $arraySize; $i++) {

                $telefono_legal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_legal[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'legal',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_legal->save();
            }
            //---------Contador de Email_Legal----------

            $arraySize = count($request->email_legal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_legal----------

                $email_legal = Proveedor_email::create([
                    'email' => $request->email_legal[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    'tipo_email' => 'legal',
                ]);
                $email_legal->save();
            }

            $Representante_legal = Persona::create([
                'dni_persona' => htmlspecialchars($request->dni_legal),
                //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                'nombre_persona' => htmlspecialchars($request->representante_legal),
                //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                //'genero_persona'=>$proveedores_rupae->genero_persona,
            ]);
            $Representante_legal->save();

            $proveedores_rupae->personas()->attach($Representante_legal);

            //----------------------------------Carga Domicilio Fiscal---------------------------------------------

            $domicilio_fiscal = Proveedor_domicilio::create([
                'tipo_domicilio' => 'fiscal',
                'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_fiscal')),
                'numero' => $request->input('numero_fiscal'),
                'lote' => htmlspecialchars($request->input('lote_fiscal')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_fiscal')),
                'monoblock' => htmlspecialchars($request->input('monoblock_fiscal')),
                'dpto' => htmlspecialchars($request->input('dpto_fiscal')),
                'puerta' => htmlspecialchars($request->input('puerta_fiscal')),
                'oficina' => htmlspecialchars($request->input('oficina_fiscal')),
                'manzana' => htmlspecialchars($request->input('manzana_fiscal')),
                'barrio' => htmlspecialchars($request->input('barrio_fiscal')),
                'id_localidad' => $request->input('localidad_fiscal'),
                'codigo_postal' => htmlspecialchars($request->input('cp_fiscal')),
            ]);
            $domicilio_fiscal->save();
            //---------Contador de Telefono_Fiscal----------

            $arraySize = count($request->telefono_fiscal);

            //---------Carga de Telefonos_Fiscal----------

            for ($i = 0; $i < $arraySize; $i++) {
                $telefono_fiscal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_fiscal[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'fiscal',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_fiscal->save();

            }

            //---------Contador de Email_fiscal----------

            $arraySize = count($request->email_fiscal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_fiscal----------

                $email_fiscal = Proveedor_email::create([
                    'email' => $request->email_fiscal[$i],
                    'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                    'tipo_email' => 'fiscal',
                ]);
                $email_fiscal->save();
            }

            //------------------------------------------SUCURSALES--------------------------------------------------------

            //---------Contador de sucursales----------
            if (isset($request->calles)) {

                $arraySize = count($request->calles);

                for ($i = 0; $i < $arraySize; $i++) {

                    //----------------Carga de Sucursal---------------

                    $sucursal = new Sucursal();
                    $sucursal->nombre_sucursal = $request->nombres_sucursales[$i];
                    $sucursal->id_proveedor = $proveedores_rupae->id_proveedor;
                    $sucursal->calle = $request->calles[$i];
                    $sucursal->numero = $request->numeros[$i];
                    $sucursal->dpto = $request->dptos[$i];
                    $sucursal->lote = $request->lotes[$i];
                    $sucursal->entre_calles = $request->entreCalles[$i];
                    $sucursal->monoblock = $request->monoblocks[$i];
                    $sucursal->id_localidad = $request->localidades[$i];
                    $sucursal->puerta = $request->puertas[$i];
                    $sucursal->oficina = $request->oficinas[$i];
                    $sucursal->manzana = $request->manzanas[$i];
                    $sucursal->codigo_postal = $request->codigos_postales[$i];
                    $sucursal->barrio = $request->barrios[$i];

                    $sucursal->save();

                    //----------------Carga de email Sucursal---------------
                    if (isset($request->correos_electronicos)) {
                        $sucursal_email = new Sucursal_email();
                        $sucursal_email->id_sucursal = $sucursal->id_sucursal;
                        $sucursal_email->email = $request->correos_electronicos[$i];
                        $sucursal_email->save();
                    }
                    //----------------Carga de telefono Sucursal---------------
                    if (isset($request->Telefonos_sucursales)) {

                        $sucursal_telefono = new Sucursal_telefono();
                        $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
                        $sucursal_telefono->nro_tel = $request->Telefonos_sucursales[$i];
                        $sucursal_telefono->save();
                    }
                    echo ($sucursal->toJson());
                }
            }

            //---------Contador de Actividades----------
            if (isset($request->tipos_actividades)) {

                $arraySize = count($request->tipos_actividades);
                var_dump($arraySize);

                //---------Carga de Actividades----------

                for ($i = 0; $i < $arraySize; $i++) {
                    $actividades_proveedores = Actividades_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'id_tipo_actividad' => $this->idtipos_actividades($request->tipos_actividades[$i]),
                        'id_actividad_economica' => $this->idActividad_economica($request->actividades[$i]),
                    ]);

                    $actividades_proveedores->save();
                }
            }

            //---------Contador de Productos----------
            if (isset($request->productos)) {

                $arraySize = count($request->productos);
                var_dump($arraySize);

                //---------Carga de Productos----------

                for ($i = 0; $i < $arraySize; $i++) {
                    $producto = Producto::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'producto_elaborado' => $request->productos[$i],
                        'Producida_unidad' => $request->unidades[$i],
                        'rnpa' => $request->rnpas[$i],
                        'capacidad_produccion_total' => $request->producciones[$i],

                    ]);

                    $producto->save();
                }
            }

            //---------Contador de Patentes----------
            if (isset($request->dominios)) {

                $arraySize = count($request->dominios);
                var_dump($arraySize);

                //---------Carga de Patentes----------

                for ($i = 0; $i < $arraySize; $i++) {
                    $Proveedor_patente = Proveedor_patente::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'dominio' => $request->dominios[$i],
                        'marca' => $request->marcas[$i],
                        'modelo' => $request->modelos[$i],
                        'inscripto_en' => $request->inscriptos[$i],

                    ]);

                    $Proveedor_patente->save();
                }
            }
            //---------Contador de Polizas----------
            if (isset($request->vigencias)) {

                $arraySize = count($request->vigencias);
                var_dump($arraySize);

                //---------Carga de Polizas----------

                for ($i = 0; $i < $arraySize; $i++) {
                    $Proveedor_seguro = Proveedor_seguro::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'poliza' => $request->polizas[$i],
                        'agencia' => $request->agencias[$i],
                        'asegurado' => $request->asegurados[$i],
                        'vigencia_hasta' => $request->vigencias[$i],

                    ]);
                    $Proveedor_seguro->save();
                }
            }

            //---------Contador de Sede----------
            if (isset($request->domicilios_sedes)) {

                $arraySize = count($request->domicilios_sedes);
                var_dump($arraySize);

                //---------Carga de Sede----------

                for ($i = 0; $i < $arraySize; $i++) {
                    $Proveedor_sede = Proveedor_sede::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'Domicilio' => $request->domicilios_sedes[$i],
                        'Localidad' => $request->localidades_sedes[$i],
                    ]);
                    $Proveedor_sede->save();
                }
            }

            //---------Contador de Pagos----------
            if (isset($request->importes_pagos)) {

                $arraySize = count($request->importes_pagos);
                var_dump($arraySize);

                //---------Carga de Pagos----------
                for ($i = 0; $i < $arraySize; $i++) {
                    $Pago = Pago::create([
                        'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                        'fecha' => $request->fechas_pagos[$i],
                        'importe' => $request->importes_pagos[$i],
                        'observaciones' => $request->observaciones_pagos[$i],

                    ]);
                    $Pago->save();
                }
            }

            return redirect()->back()->with('message', 'Registro creado correctamente');
        } else {

            $proveedor = Proveedor::where('cuit', $request->cuit)->first();

            return redirect()->route('modificarRegistro',['id' =>$proveedor->id_proveedor ]);
           //$this->obtenerProveedorRupaeId();

            /*return Redirect::back()
                ->withErrors(['El CUIT ingresado ya existe, la operación no pudo completarse']);
*/
            }
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
            //$data = Proveedor::latest()->where('dado_de_baja', 0)->get();
            $data = Proveedor::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->dado_de_baja == 0)
                    {
                        $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaRegistro(' . $row->id_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                    }
                    else
                    {
                        $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="altaRegistro(' . $row->id_proveedor . ');" class="alta btn btn-success btn-sm" title="Dar de alta"><i class="fas fa-arrow-alt-circle-up"></i></a>';

                        /*$actionBtn = '<a onclick="altaRegistro(' . $row->id_proveedor . ');" class="alta btn btn-success btn-sm" title="Dar de alta"><i class="fas fa-arrow-alt-circle-up"></i></a>';*/
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getSucursales(Request $request, $id, $mode)
    {   
        if ($request->ajax()) {
            $data = Sucursal::with(['telefonos','emails'])
                        ->where('id_proveedor', $id)
                        ->get();
            Log::info('sucursal editar'.$data);
        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarSucursales/' . $row->id_sucursal);
                    $url2 = url('verSucursales/' . $row->id_sucursal);

                    if ($mode == "show") {
                        $actionBtn = ' <a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                        <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                        <i class="fas fa-edit"></i></a> <a onclick="bajaSucursal(' . $row->id_sucursal . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                        <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }



                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
    public function editarSucursales($id)
    {
        $sucursal = Sucursal::where('id_sucursal', $id)->get();
        $sucursal_email = Sucursal_email::where('id_sucursal', $id)->get();
        $sucursal_telefono = Sucursal_telefono::where('id_sucursal', $id)->get();
        if(empty($sucursal_email[0])){
            $sucursal_email = "";
        }
        else{
        $sucursal_email = $sucursal_email[0];
        }
        $sucursal = $sucursal[0];
        if (empty($sucursal_telefono[0])) {
            $sucursal_telefono = "";
        } else {
            $sucursal_telefono = $sucursal_telefono[0];
        }

        $provinciaid = Localidad::where('id_localidad', $sucursal->id_localidad)->get();
        if ( empty($provinciaid[0]->id_provincia)) {
            $provinciaid = "";
        } else {
            $provinciaid = $provinciaid[0]->id_provincia;
        }

        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $mode = "edit";

        return view('ediciones.sucursales', compact( 'provinciaid','mode','sucursal', 'sucursal_email', 'sucursal_telefono','paises','provincias','localidades'));

    }

    public function verSucursales($id)
    {
        $sucursal = Sucursal::where('id_sucursal', $id)->get();
        $sucursal_email = Sucursal_email::where('id_sucursal', $id)->get();
        $sucursal_telefono = Sucursal_telefono::where('id_sucursal', $id)->get();
        $sucursal_email = $sucursal_email[0];
        $sucursal = $sucursal[0];
        $sucursal_telefono = $sucursal_telefono[0];
        $provinciaid = Localidad::where('id_localidad', $sucursal->id_localidad)->get();
        $provinciaid = $provinciaid[0]->id_provincia;
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $mode = "show";

        return view('ediciones.sucursales', compact('provinciaid','mode','sucursal', 'sucursal_email', 'sucursal_telefono','paises','provincias','localidades'));

    }

    public function bajaSucursales($id)
    {
        Sucursal_email::where('id_sucursal', $id)->delete();
        Sucursal_telefono::where('id_sucursal', $id)->delete();
        Sucursal::findOrFail($id)->delete();

        return "success";
    }

    public function guardarSucursales($id, Request $request)
    {
        $sucursal = Sucursal::find($id);

        $sucursal_email = Sucursal_email::where('id_sucursal', $id)->first();
        //return response()->json($sucursal_email);
        if (!empty($sucursal_email)) {
            $sucursal_email->update([
                'email' => $request->email,
            ]);

            $sucursal_email->save();
        } else {
            //----------------Carga de email Sucursal---------------
            if (isset($request->email)) {
                $sucursal_email = new Sucursal_email();
                $sucursal_email->id_sucursal = $sucursal->id_sucursal;
                $sucursal_email->email = $request->email;
                $sucursal_email->save();
            }
        }
        $sucursal_telefono = Sucursal_telefono::where('id_sucursal', $id)->first();

        if (!empty($sucursal_telefono)) {
            $sucursal_telefono->update([
                'nro_tel' => $request->nro_tel,
            ]);
            $sucursal_telefono->save();
        } else {
             //----------------Carga de telefono Sucursal---------------
            if (isset($request->nro_tel)) {

                $sucursal_telefono = new Sucursal_telefono();
                $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
                $sucursal_telefono->nro_tel = $request->nro_tel;
                $sucursal_telefono->save();
            }
        }

        $sucursal = $sucursal->fill($request->all());
        $sucursal->save();
        return redirect()->back()->with('message', 'Los datos de la Sucursal fueron modificados correctamente');
    }

    public function crearSucursales($id, Request $request)
    {
        //----------------Carga de Sucursal---------------

        $sucursal = new Sucursal($request->all());
        $sucursal->id_proveedor = $id;
        $sucursal->save();

        //----------------Carga de email Sucursal---------------
        if (isset($request->email)) {
            $sucursal_email = new Sucursal_email();
            $sucursal_email->id_sucursal = $sucursal->id_sucursal;
            $sucursal_email->email = $request->email;
            $sucursal_email->save();
        }
        //----------------Carga de telefono Sucursal---------------
        if (isset($request->nro_tel)) {

            $sucursal_telefono = new Sucursal_telefono();
            $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
            $sucursal_telefono->nro_tel = $request->nro_tel;
            $sucursal_telefono->save();
        }
        $sucursal->save();
        return redirect()->back()->with('message', 'Sucursal Creada Correctamente');
    }

    public function nuevoSucursales($id)
    {
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $mode = "create";

        return view('ediciones.sucursales', compact( 'id','mode','paises','provincias','localidades'));

    }

    public function getPagos(Request $request, $id, $mode = null)
    {
        //if ($request->ajax()) {
        $data = Pago::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode) {
                $url = url('editarPagos/' . $row->id_pagos);
                $url2 = url('verPagos/' . $row->id_pagos);

                if ($mode == "show") {
                    $actionBtn = ' <a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaPago(' . $row->id_pagos . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                }



            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }
    public function editarPagos($id)
    {
        $pago = Pago::where('id_pagos', $id)->get();
        $mode = "edit";


        return view('ediciones.pagos',compact('mode'), (['pago' => $pago[0]]));

    }

    public function verPagos($id)
    {
        $pago = Pago::where('id_pagos', $id)->get();
        $mode = "show";


        return view('ediciones.pagos',compact('mode'), (['pago' => $pago[0]]));

    }

    public function guardarPagos($id, Request $request)
    {
        $pago = Pago::find($id);

        $pago = $pago->fill($request->all());
        $pago->save();
        return redirect()->back()->with('message', 'Los datos del Pago fueron modificados correctamente');

    }

    public function crearPagos($id, Request $request)
    {

        $pago = new Pago($request->all());
        $pago->id_proveedor = $id;
        $pago->save();
        return redirect()->back()->with('message', 'Pago Creado Correctamente');

    }

    public function nuevoPagos($id)
    {
        $mode = "create";

        return view('ediciones.pagos', compact( 'id','mode'));

    }


    public function bajaPagos($id)
    {
        $pago = Pago::findOrFail($id)->delete();

        return "success";

    }

    public function getActividades(Request $request, $id, $mode = null)
    {
        //if ($request->ajax()) {
        $data = Actividades_proveedores::where('id_proveedor', $id)
        ->join('actividades_economicas', 'actividades_proveedores.id_actividad_economica', '=', 'actividades_economicas.id_actividad_economica')
        ->join('tipos_actividades', 'actividades_proveedores.id_tipo_actividad', '=', 'tipos_actividades.id_tipo_actividad')
        ->select('actividades_proveedores.id_actividad_economica','actividades_proveedores.id_actividad_proveedor','actividades_proveedores.id_tipo_actividad','actividades_economicas.desc_actividad','actividades_economicas.cod_actividad','tipos_actividades.desc_tipo_actividad')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode){
                $url = url('editarActividades/' . $row->id_actividad_proveedor);
                $url2 = url('verActividades/' . $row->id_actividad_proveedor);
                if ($mode == "show") {
                    $actionBtn = ' <a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a> ';
                    return $actionBtn;                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaActividad(' . $row->id_actividad_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                }


            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarActividades($id)
    {
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $actividad = Actividades_proveedores::where('id_actividad_proveedor', $id)->get();
        $actividad = $actividad[0];
        $mode = "edit";

        return view('ediciones.actividades', compact('mode','actividad', 'tipos_actividades', 'actividades'));

    }

    public function verActividades($id)
    {
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $actividad = Actividades_proveedores::where('id_actividad_proveedor', $id)->get();
        $actividad = $actividad[0];
        $mode = "show";

        return view('ediciones.actividades', compact('mode','actividad', 'tipos_actividades', 'actividades'));

    }

    public function crearActividades($id, Request $request)
    {

        if($request->tipo_actividad == "Primaria"){
        if (Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {

            return Redirect::back()
                ->withErrors(['Ya existe una actividad primaria, la operación no pudo completarse']);
            }
            else {
            $actividad = new Actividades_proveedores();
            $actividad->id_proveedor = $id;
            $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
            $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

            $actividad->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Actividad Creada Correctamente');
        }}
        else{
            $actividad = new Actividades_proveedores();
            $actividad->id_proveedor = $id;
            $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
            $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

            $actividad->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Actividad Creada Correctamente');
        }

    }

    public function nuevoActividades($id)
    {
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $mode = "create";

        return view('ediciones.actividades', compact( 'id','actividades', 'tipos_actividades','mode'));

    }

    public function bajaActividades($id)
    {
        if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
            return false;
        } else {
            Actividades_proveedores::findOrFail($id)->delete();
            return "success";
        }
    }

    public function guardarActividades($id, Request $request)
    {

        if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
            $actividad = Actividades_proveedores::find($id);
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();

            $actividad->update([
                'id_actividad_economica' => $this->idActividad_economica($request->actividad_1),
            ]);

            $actividad->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');
            }
            else {
            $actividad = Actividades_proveedores::find($id);
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();

            $actividad->update([
                'id_actividad_economica' => $this->idActividad_economica($request->actividad_1),
            ]);

            $actividad->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');
        }


    }

    public function getProductos(Request $request, $id, $mode = null)
    {
        //if ($request->ajax()) {
        $data = Producto::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode) {
                $url = url('editarProductos/' . $row->id_producto);
                $url2 = url('verProductos/' . $row->id_producto);

                if ($mode == "show") {
                    $actionBtn = '<a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaProducto(' . $row->id_producto . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                }


            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarProductos($id)
    {
        $producto = Producto::where('id_producto', $id)->get();
        $producto = $producto[0];
        $productos = Producto::All();
        $mode = "edit";


        return view('ediciones.producto', compact('mode','producto','productos'));

    }
    public function verProductos($id)
    {
        $producto = Producto::where('id_producto', $id)->get();
        $producto = $producto[0];
        $productos = Producto::All();
        $mode = "show";


        return view('ediciones.producto', compact('mode','producto','productos'));

    }

    public function bajaProductos($id)
    {
        Producto::findOrFail($id)->delete();
        return "success";
    }

    public function crearProductos($id, Request $request)
    {
            $producto = new Producto($request->all());
            $producto->id_proveedor = $id;
            $producto->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Producto Creado Correctamente');
    }

    public function nuevoProductos($id)
    {
        $productos = Producto::All();

        $mode = "create";

        return view('ediciones.producto', compact('mode','id','productos'));

    }

    public function guardarProductos($id, Request $request)
    {
        $producto = Producto::find($id);

        $producto = $producto->fill($request->all());
        $productos = Producto::All();

        $producto->save();
        return redirect()->back()->with('message', 'Los datos del Producto fueron modificados correctamente');

    }

    public function getPatentes(Request $request, $id, $mode =null)
    {
        //if ($request->ajax()) {
        $data = Proveedor_patente::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode) {
                $url = url('editarPatentes/' . $row->id_proveedor_patente);
                $url2 = url('verPatentes/' . $row->id_proveedor_patente);

                if ($mode == "show") {
                    $actionBtn = ' <a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="bajaPatente(' . $row->id_proveedor_patente . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                 }



            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarPatentes($id)
    {
        $patente = Proveedor_patente::where('id_proveedor_patente', $id)->get();
        $patente = $patente[0];
        $mode = "edit";
        return view('ediciones.patentes', compact('mode','patente'));

    }

    public function verPatentes($id)
    {
        $patente = Proveedor_patente::where('id_proveedor_patente', $id)->get();
        $patente = $patente[0];
        $mode = "show";
        return view('ediciones.patentes', compact('mode','patente'));

    }

    public function bajaPatentes($id)
    {
        Proveedor_patente::findOrFail($id)->delete();
        return "success";
    }

    public function crearPatentes($id, Request $request)
    {
            $patente = new Proveedor_patente($request->all());
            $patente->id_proveedor = $id;
            $patente->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Vehículo creado correctamente');
    }

    public function nuevoPatentes($id)
    {
        $mode = "create";

        return view('ediciones.patentes', compact('mode','id'));

    }

    public function guardarPatentes($id, Request $request)
    {
        $patente = Proveedor_patente::find($id);

        $patente = $patente->fill($request->all());
        $patente->save();
        return redirect()->back()->with('message', 'Los datos del Vehículo fueron modificados correctamente');

    }

    public function getSeguros(Request $request, $id,$mode = null)
    {
        //if ($request->ajax()) {
        $data = Proveedor_seguro::where('id_proveedor', $id)->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode) {
                $url = url('editarSeguros/' . $row->id_proveedor_seguro);
                $url2 = url('verSeguros/' . $row->id_proveedor_seguro);

                if ($mode == "show") {
                    $actionBtn = '<a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>

                    <a onclick="bajaSeguro(' . $row->id_proveedor_seguro . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                }



            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarSeguros($id)
    {
        $seguro = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
        $seguro = $seguro[0];
        $mode = "edit";

        return view('ediciones.seguros', compact('mode','seguro'));

    }

    public function verSeguros($id)
    {
        $seguro = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
        $seguro = $seguro[0];
        $mode = "show";

        return view('ediciones.seguros', compact('mode','seguro'));

    }

    public function bajaSeguros($id)
    {
        Proveedor_seguro::findOrFail($id)->delete();
        return "success";
    }

    public function crearSeguros($id, Request $request)
    {
            $seguro = new Proveedor_seguro($request->all());
            $seguro->id_proveedor = $id;
            $seguro->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Seguro Creado Correctamente');
    }

    public function nuevoSeguros($id)
    {
        $mode = "create";

        return view('ediciones.seguros', compact('mode','id'));

    }

    public function guardarSeguros($id, Request $request)
    {
        $seguro = Proveedor_seguro::find($id);

        $seguro = $seguro->fill($request->all());
        $seguro->save();
        return redirect()->back()->with('message', 'Los datos del Seguro fueron modificados correctamente');

    }

    public function getSedes(Request $request, $id, $mode = null)
    {
        //if ($request->ajax()) {
        //$data = Proveedor_sede::where('id_proveedor', $id)->get();

        $data = Proveedor_sede::join("localidades","localidades.id_localidad", "=", "proveedores_sede.Localidad")->where("proveedores_sede.id_proveedor", "=", $id)->select("proveedores_sede.id_proveedor_sede","proveedores_sede.Domicilio","localidades.nombre_localidad")->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($mode) {
                $url = url('editarSedes/' . $row->id_proveedor_sede);
                $url2 = url('verSedes/' . $row->id_proveedor_sede);

                if ($mode=="show") {
                    $actionBtn = '<a href="' . "$url2" . '" class="view btn btn-primary btn-sm" title="Ver">
                    <i class="fas fa-eye"></i></a> ';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="bajaSede(' . $row->id_proveedor_sede . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;                }



            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarSedes($id)
    {
        $sede = Proveedor_sede::where('id_proveedor_sede', $id)->get();
        $sede = $sede[0];
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $provinciaid = Localidad::where('id_localidad', $sede->Localidad)->get();
        if ( empty($provinciaid[0]->id_provincia)) {
            $provinciaid = "";
        } else {
            $provinciaid = $provinciaid[0]->id_provincia;
        }
        $mode = "edit";
        return view('ediciones.sedes', compact('sede','mode','provincias','localidades','paises','provinciaid'));

    }

    public function verSedes($id)
    {
        $sede = Proveedor_sede::where('id_proveedor_sede', $id)->get();
        $sede = $sede[0];
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $provinciaid = Localidad::where('id_localidad', $sede->Localidad)->get();
        $provinciaid = $provinciaid[0]->id_provincia;
        $mode = "show";
        return view('ediciones.sedes', compact('sede','mode','provincias','localidades','paises','provinciaid'));

    }

    public function bajaSedes($id)
    {
        Proveedor_sede::findOrFail($id)->delete();
        return "success";
    }

    public function crearSedes($id, Request $request)
    {
            $sede = new Proveedor_sede($request->all());
            $sede->id_proveedor = $id;
            $sede->save();

            // return view('ediciones.actividades',  compact('actividad','tipos_actividades','actividades'));

            return redirect()->back()->with('message', 'Sede creada correctamente');
    }

    public function nuevoSedes($id)
    {
        $mode = "create";
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();


        return view('ediciones.sedes', compact('id','mode','provincias','localidades','paises'));

    }

    public function guardarSedes($id, Request $request)
    {
        $sede = Proveedor_sede::find($id);

        $sede = $sede->fill($request->all());
        $sede->save();
        return redirect()->back()->with('message', 'Los datos de la Sede fueron modificados correctamente');

    }

    /*public function obtenerDatosProveedor($id){
    $proveedores_rupae = new Proveedor_rupae();
    $datos = $proveedores_rupae->obtenerProveedorRupaeId($id);
    return $datos;
    }*/

    /*
    En esta función obtenemos cada uno de los datos de las distintas tablas, de un proveedor.
     */

    public function obtenerProveedorRupaeId2($id)
    {
        $proveedor = DB::table('proveedores')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

        if (!empty($proveedor_domicilio_fiscal->id_localidad)) {
            $proveedor_localidades_fiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->first();
        } else {
            $proveedor_localidades_fiscal = "";
        }
        if (!empty($proveedor_localidades_fiscal->id_provincia)) {

            $proveedor_provincias_fiscal = Provincia::where('id_provincia', $proveedor_localidades_fiscal->id_provincia)->first();

        } else {
            $proveedor_provincias_fiscal = null;
        }

        $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
            ->get();

        //return $proveedor_email_fiscal;

        $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
            ->get();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        if (!empty($proveedor_domicilio_legal->id_localidad)) {

            $proveedor_localidades_legal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->first();

        } else {
            $proveedor_localidades_legal = "";
        }
        if (!empty($proveedor_domicilio_legal->id_provincia)) {

            $proveedor_provincias_legal = Provincia::where('id_provincia', $proveedor_localidades_legal->id_provincia)->first();
        } else {
            $proveedor_provincias_legal = null;
        }

        $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
            ->get();

        $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
            ->get();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();
        if (!empty($proveedor_domicilio_real->id_provincia)) {

            $proveedor_localidades_real = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->first();
        } else {
            $proveedor_localidades_real = "";
        }
        if (!empty($proveedor_domicilio_real->id_provincia)) {

            $proveedor_provincias_real = Provincia::where('id_provincia', $proveedor_localidades_real->id_provincia)->first();
        } else {
            $proveedor_provincias_real = "";
        }

        $proveedor_email_real = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'real')
            ->get();

        $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')
            ->get();

        $proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $id)->get();

        $sucursales = Sucursal::where('id_proveedor', $id)->get();

        //return $sucursales;

        // $sucursales_email = Sucursal_email::where('id_sucursal', $sucursales[0]->id_sucursal)->get();

        // $sucursales_telefono = Sucursal_telefono::where('id_sucursal', $sucursales[0]->id_sucursal)->get();

        $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

        $productos = Producto::where('id_proveedor', $id)->get();

        $patentes = Proveedor_patente::where('id_proveedor', $id)->get();

        $seguros = Proveedor_seguro::where('id_proveedor', $id)->get();

        $sedes = Proveedor_sede::where('id_proveedor', $id)->get();

        $pagos = Pago::where('id_proveedor', $id)->get();

        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $productos = Producto::All();
        $ponderaciones = Ponderacion_compre_local::All();
        $jerarquias = Jerarquia_compre_local::All();

        return view('editarRegistro', compact('paises', 'jerarquias', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones'), [
            'proveedor' => $proveedor,
            'id' => $id,
            'proveedor_telefono_fiscal' => $proveedor_telefono_fiscal,
            'proveedor_domicilio_fiscal' => $proveedor_domicilio_fiscal,
            'proveedor_email_fiscal' => $proveedor_email_fiscal,
            'proveedor_telefono_legal' => $proveedor_telefono_legal,
            'proveedor_domicilio_legal' => $proveedor_domicilio_legal,
            'proveedor_email_legal' => $proveedor_email_legal,
            'proveedor_telefono_real' => $proveedor_telefono_real,
            'proveedor_domicilio_real' => $proveedor_domicilio_real,
            'proveedor_email_real' => $proveedor_email_real,
            'proveedor_localidades_real' => $proveedor_localidades_real,
            'proveedor_provincias_real' => $proveedor_provincias_real,
            'proveedor_localidades_legal' => $proveedor_localidades_legal,
            'proveedor_provincias_legal' => $proveedor_provincias_legal,
            'proveedor_localidades_fiscal' => $proveedor_localidades_fiscal,
            'proveedor_provincias_fiscal' => $proveedor_provincias_fiscal,
            'proveedores_tipos_proveedores' => $proveedores_tipos_proveedores,
            'sucursales' => $sucursales,
            //'sucursales_email' => $sucursales_email,
            //'sucursales_telefono' => $sucursales_telefono,
            'actividades' => $actividades,
            'productos ' => $productos,
            'patentes' => $patentes,
            'seguros' => $seguros,
            'sedes' => $sedes,
            'pagos' => $pagos,
        ]);
    }

    public function obtenerProveedorRupaeId($id,$tab = null)
    {
        $proveedor = Proveedor::findOrFail($id);

        $persona = $proveedor->personas()->get();

        if ($persona->isEmpty()) {
            $persona =  "";

        }
        else{
            $persona = $persona[0];
        }

        //return $persona;
        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

        $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();

        if ($provinciaidFiscal->isEmpty()) {
            $provinciaidFiscal =  "";
        } else {
            $provinciaidFiscal =  $provinciaidFiscal[0]->id_provincia;
        }

        $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
            ->get();

        $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
            ->get();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        $provinciaidLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

        if ($provinciaidLegal->isEmpty()) {
            $provinciaidLegal =  "";
        } else {
            $provinciaidLegal =  $provinciaidLegal[0]->id_provincia;
        }

        $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
            ->get();

        $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
            ->get();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();

        $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

        if ($provinciaidReal->isEmpty()) {
            $provinciaidReal =  "";
        } else {
            $provinciaidReal =  $provinciaidReal[0]->id_provincia;
        }

        $proveedor_email_real = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'real')
            ->get();

        $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')
            ->get();

        $proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $id)->get();

        $sucursales = Sucursal::where('id_proveedor', $id)->get();

        $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

        $productos = Producto::where('id_proveedor', $id)->get();

        $patentes = Proveedor_patente::where('id_proveedor', $id)->get();

        $seguros = Proveedor_seguro::where('id_proveedor', $id)->get();

        $sedes = Proveedor_sede::where('id_proveedor', $id)->get();

        $pagos = Pago::where('id_proveedor', $id)->get();

        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $productos = Producto::All();
        $ponderaciones = Ponderacion_compre_local::All();
        $jerarquias = Jerarquia_compre_local::All();

        $mode = "edit";

        return view('editarRegistro', compact('tab','persona', 'mode',
        'provinciaidReal','provinciaidLegal','provinciaidFiscal','paises', 'jerarquias', 'provincias','localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones','proveedor',
        'id' ,'proveedor_telefono_fiscal','proveedor_domicilio_fiscal' ,'proveedor_email_fiscal' ,'proveedor_telefono_legal' ,'proveedor_domicilio_legal' ,
        'proveedor_email_legal' ,'proveedor_telefono_real' ,'proveedor_domicilio_real' ,'proveedor_email_real' ,'proveedores_tipos_proveedores',
        'sucursales', 'actividades' ,'productos' ,'patentes' ,'seguros' , 'sedes', 'pagos')
        );
    }

    public function verProveedorRupaeId($id,$tab = null)
    {
        $proveedor = Proveedor::findOrFail($id);
        $persona = $proveedor->personas()->get();

        if ($persona->isEmpty()) {
            $persona =  "";

        }
        else{
            $persona = $persona[0];
        }
        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
        ->first();
        if (empty($proveedor_domicilio_fiscal)) {
            $proveedor_domicilio_fiscal =  "";
            $provinciaidFiscal =  "";
        } else {
            $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();


            if ($provinciaidFiscal->isEmpty()) {
                $provinciaidFiscal =  "";
            } else {
                $provinciaidFiscal =  $provinciaidFiscal[0]->id_provincia;
            }
        }





        $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
            ->get();

        $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
            ->get();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        $provinciaidLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

        if ($provinciaidLegal->isEmpty()) {
            $provinciaidLegal =  "";
        } else {
            $provinciaidLegal =  $provinciaidLegal[0]->id_provincia;
        }

        $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
            ->get();

        $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
            ->get();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();

        $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

        if ($provinciaidReal->isEmpty()) {
            $provinciaidReal =  "";
        } else {
            $provinciaidReal =  $provinciaidReal[0]->id_provincia;
        }


        $proveedor_email_real = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'real')
            ->get();

        $proveedor_telefono_real = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'real')
            ->get();

        $proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $id)->get();

        $sucursales = Sucursal::where('id_proveedor', $id)->get();

        $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

        $productos = Producto::where('id_proveedor', $id)->get();

        $patentes = Proveedor_patente::where('id_proveedor', $id)->get();

        $seguros = Proveedor_seguro::where('id_proveedor', $id)->get();

        $sedes = Proveedor_sede::where('id_proveedor', $id)->get();

        $pagos = Pago::where('id_proveedor', $id)->get();

        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $productos = Producto::All();
        $ponderaciones = Ponderacion_compre_local::All();
        $jerarquias = Jerarquia_compre_local::All();
        $mode = "show";


        return view('verRegistro', compact('tab','persona', 'mode',
        'provinciaidReal','provinciaidLegal','provinciaidFiscal','paises', 'jerarquias', 'provincias','localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones','proveedor',
        'id' ,'proveedor_telefono_fiscal','proveedor_domicilio_fiscal' ,'proveedor_email_fiscal' ,'proveedor_telefono_legal' ,'proveedor_domicilio_legal' ,
        'proveedor_email_legal' ,'proveedor_telefono_real' ,'proveedor_domicilio_real' ,'proveedor_email_real' ,'proveedores_tipos_proveedores',
        'sucursales', 'actividades' ,'productos' ,'patentes' ,'seguros' , 'sedes', 'pagos')
        );
    }

    public function editarProveedor($id, Request $request)
    {
        $proveedor = Proveedor::find($id);

        $persona = $proveedor->personas()->get();

        if ($persona->isEmpty()) {

            if($request->dni_legal || $request->representante_legal){
            $persona = Persona::create([
                'dni_persona' => htmlspecialchars($request->dni_legal),
                //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                'nombre_persona' => htmlspecialchars($request->representante_legal),
                //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                //'genero_persona'=>$proveedores_rupae->genero_persona,
            ]);
            $persona->save();
            $proveedor->personas()->attach($persona);

            //$persona =  "";
            }
            else{
                $persona = "";
            }
        }
        else{
            $persona = $proveedor->personas()->first();
            $persona->update([
                'dni_persona' => htmlspecialchars($request->dni_legal),
                //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                'nombre_persona' => htmlspecialchars($request->representante_legal),
                //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                //'genero_persona'=>$proveedores_rupae->genero_persona,
            ]);
            $persona->save();

        }
        //----------------------------------Editar Domicilio Real---------------------------------------------

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
        ->get();
        if ($proveedor_domicilio_real->isEmpty()) {

            if($request->input('calle_real')){
                $proveedor_domicilio_real = Proveedor_domicilio::create([
                    'tipo_domicilio' => 'real',
                    //'nro_orden_domicilio',
                    'calle' => htmlspecialchars($request->input('calle_real')),
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'numero' => $request->input('numero_real'),
                    'dpto' => htmlspecialchars($request->input('dpto_real')),
                    'puerta' => htmlspecialchars($request->input('puerta_real')),
                    'lote' => htmlspecialchars($request->input('lote_real')),
                    'manzana' => htmlspecialchars($request->input('manzana_real')),
                    'entre_calles' => htmlspecialchars($request->input('entreCalles_real')),
                    'oficina' => htmlspecialchars($request->input('oficina_real')),
                    'monoblock' => htmlspecialchars($request->input('monoblock_real')),
                    'barrio' => htmlspecialchars($request->input('barrio_real')),
                    'id_localidad' => $request->input('localidad_real'),
                    'codigo_postal' => htmlspecialchars($request->input('cp_real')),
                ]);
                $proveedor_domicilio_real->save();

            //---------Contador de Telefono_Real----------

            $arraySize = count($request->telefono_real);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Telefonos_Real----------

                $telefono_real = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_real[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'real',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_real->save();
            }

            //---------Contador de Email_Real----------

            $arraySize = count($request->email_real);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_Real----------

                $email_real = Proveedor_email::create([
                    'email' => $request->email_real[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'real',
                ]);
                $email_real->save();
            }

            }
            else{
                $proveedor_domicilio_real = "";
            }
        }
        else{
            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();

            $proveedor_domicilio_real->update([
                'tipo_domicilio' => 'real',
                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_real')),
                'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                'numero' => $request->input('numero_real'),
                'dpto' => htmlspecialchars($request->input('dpto_real')),
                'puerta' => htmlspecialchars($request->input('puerta_real')),
                'lote' => htmlspecialchars($request->input('lote_real')),
                'manzana' => htmlspecialchars($request->input('manzana_real')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_real')),
                'oficina' => htmlspecialchars($request->input('oficina_real')),
                'monoblock' => htmlspecialchars($request->input('monoblock_real')),
                'barrio' => htmlspecialchars($request->input('barrio_real')),
                'id_localidad' => $request->input('localidad_real'),
                'codigo_postal' => htmlspecialchars($request->input('cp_real')),
            ]);
            $proveedor_domicilio_real->save();

            //---------Contador de Telefono_Real----------

            $telefonos_real = Proveedor_telefono::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_telefono', 'real')->get();
            //return $telefonos_real;

            $i = 0;
            foreach ($telefonos_real as $k){
                //return $request->telefono_real[$i];

                $telefono_real = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                $telefono_real->update([
                    'nro_tel' => $request->telefono_real[$i]
                ]);
                $telefono_real->save();
                $i++;

            }

            $arraySize = count($request->telefono_real);
            if($i<2){
                for ($i; $i < $arraySize; $i++) {
                    //---------Carga de Telefonos_Real----------

                    $telefono_real = Proveedor_telefono::create([
                        'nro_tel' => $request->telefono_real[$i],
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        //'cod_area_tel' =>,
                        //'tipo_medio'=>,
                        //'desc_telefono'=>,
                        'tipo_telefono' => 'real',
                        //'nro_orden_telefono'=>,
                    ]);
                    $telefono_real->save();
                }
            }
            //---------Contador de Email_Real----------

            $emails_real = Proveedor_email::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_email', 'real')->get();
            //return $emails_real;
            $i = 0;
            foreach ($emails_real as $j){
                //return $request->email_real[$i];

                $email_real = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                $email_real->update([
                    'email' => $request->email_real[$i],
                ]);
                $email_real->save();
                $i++;

            }


            $arraySize = count($request->email_real);
            if($i<2){


            for ($i; $i < $arraySize ; $i++) {
                $email_real = Proveedor_email::create([
                    'email' => $request->email_real[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'real',
                ]);
                $email_real->save();

             }
            }



            }
            //----------------------------------Editar Domicilio Legal---------------------------------------------

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
        ->get();
        if ($proveedor_domicilio_legal->isEmpty()) {

            if($request->input('calle_legal')){
                $proveedor_domicilio_legal = Proveedor_domicilio::create([
                    'tipo_domicilio' => 'legal',
                    //'nro_orden_domicilio',
                    'calle' => htmlspecialchars($request->input('calle_legal')),
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'numero' => $request->input('numero_legal'),
                    'dpto' => htmlspecialchars($request->input('dpto_legal')),
                    'puerta' => htmlspecialchars($request->input('puerta_legal')),
                    'lote' => htmlspecialchars($request->input('lote_legal')),
                    'manzana' => htmlspecialchars($request->input('manzana_legal')),
                    'entre_calles' => htmlspecialchars($request->input('entreCalles_legal')),
                    'oficina' => htmlspecialchars($request->input('oficina_legal')),
                    'monoblock' => htmlspecialchars($request->input('monoblock_legal')),
                    'barrio' => htmlspecialchars($request->input('barrio_legal')),
                    'id_localidad' => $request->input('localidad_legal'),
                    'codigo_postal' => htmlspecialchars($request->input('cp_legal')),
                ]);
                $proveedor_domicilio_legal->save();

            //---------Contador de Telefono_Legal----------

            $arraySize = count($request->telefono_legal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Telefonos_Legal----------

                $telefono_legal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_legal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'legal',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_legal->save();
            }

            //---------Contador de Email_Legal----------

            $arraySize = count($request->email_legal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_Legal----------

                $email_legal = Proveedor_email::create([
                    'email' => $request->email_legal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'legal',
                ]);
                $email_legal->save();
            }

            }
            else{
                $proveedor_domicilio_legal = "";
            }
        }
        else{
            $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

            $proveedor_domicilio_legal->update([
                'tipo_domicilio' => 'legal',
                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_legal')),
                'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                'numero' => $request->input('numero_legal'),
                'dpto' => htmlspecialchars($request->input('dpto_legal')),
                'puerta' => htmlspecialchars($request->input('puerta_legal')),
                'lote' => htmlspecialchars($request->input('lote_legal')),
                'manzana' => htmlspecialchars($request->input('manzana_legal')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_legal')),
                'oficina' => htmlspecialchars($request->input('oficina_legal')),
                'monoblock' => htmlspecialchars($request->input('monoblock_legal')),
                'barrio' => htmlspecialchars($request->input('barrio_legal')),
                'id_localidad' => $request->input('localidad_legal'),
                'codigo_postal' => htmlspecialchars($request->input('cp_legal')),
            ]);
            $proveedor_domicilio_legal->save();

            //---------Contador de Telefono_Legal----------

            $telefonos_legal = Proveedor_telefono::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_telefono', 'legal')->get();
            //return $telefonos_legal;

            $i = 0;
            foreach ($telefonos_legal as $k){
                //return $request->telefono_legal[$i];

                $telefono_legal = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                $telefono_legal->update([
                    'nro_tel' => $request->telefono_legal[$i],
                ]);
                $telefono_legal->save();
                $i++;

            }

            $arraySize = count($request->telefono_legal);
            if($i<2){
                for ($i; $i < $arraySize; $i++) {
                    //---------Carga de Telefonos_Legal----------

                    $telefono_legal = Proveedor_telefono::create([
                        'nro_tel' => $request->telefono_legal[$i],
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        //'cod_area_tel' =>,
                        //'tipo_medio'=>,
                        //'desc_telefono'=>,
                        'tipo_telefono' => 'legal',
                        //'nro_orden_telefono'=>,
                    ]);
                    $telefono_legal->save();
                }
            }
            //---------Contador de Email_Legal----------

            $emails_legal = Proveedor_email::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_email', 'legal')->get();
            //return $emails_legal;
            $i = 0;
            foreach ($emails_legal as $j){
                //return $request->email_legal[$i];

                $email_legal = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                $email_legal->update([
                    'email' => $request->email_legal[$i],
                ]);
                $email_legal->save();
                $i++;

            }


            $arraySize = count($request->email_legal);
            if($i<2){


            for ($i; $i < $arraySize ; $i++) {
                $email_legal = Proveedor_email::create([
                    'email' => $request->email_legal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'legal',
                ]);
                $email_legal->save();

             }
            }



            }
            //----------------------------------Editar Domicilio Fiscal---------------------------------------------

        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
        ->get();
        if ($proveedor_domicilio_fiscal->isEmpty()) {

            if($request->input('calle_fiscal')){
                $proveedor_domicilio_fiscal = Proveedor_domicilio::create([
                    'tipo_domicilio' => 'fiscal',
                    //'nro_orden_domicilio',
                    'calle' => htmlspecialchars($request->input('calle_fiscal')),
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'numero' => $request->input('numero_fiscal'),
                    'dpto' => htmlspecialchars($request->input('dpto_fiscal')),
                    'puerta' => htmlspecialchars($request->input('puerta_fiscal')),
                    'lote' => htmlspecialchars($request->input('lote_fiscal')),
                    'manzana' => htmlspecialchars($request->input('manzana_fiscal')),
                    'entre_calles' => htmlspecialchars($request->input('entreCalles_fiscal')),
                    'oficina' => htmlspecialchars($request->input('oficina_fiscal')),
                    'monoblock' => htmlspecialchars($request->input('monoblock_fiscal')),
                    'barrio' => htmlspecialchars($request->input('barrio_fiscal')),
                    'id_localidad' => $request->input('localidad_fiscal'),
                    'codigo_postal' => htmlspecialchars($request->input('cp_fiscal')),
                ]);
                $proveedor_domicilio_fiscal->save();

            //---------Contador de Telefono_Fiscal----------

            $arraySize = count($request->telefono_fiscal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Telefonos_Fiscal----------

                $telefono_fiscal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_fiscal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    //'cod_area_tel' =>,
                    //'tipo_medio'=>,
                    //'desc_telefono'=>,
                    'tipo_telefono' => 'fiscal',
                    //'nro_orden_telefono'=>,
                ]);
                $telefono_fiscal->save();
            }

            //---------Contador de Email_Fiscal----------

            $arraySize = count($request->email_fiscal);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Email_Fiscal----------

                $email_fiscal = Proveedor_email::create([
                    'email' => $request->email_fiscal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'fiscal',
                ]);
                $email_fiscal->save();
            }

            }
            else{
                $proveedor_domicilio_fiscal = "";
            }
        }
        else{
            $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

            $proveedor_domicilio_fiscal->update([
                'tipo_domicilio' => 'fiscal',
                //'nro_orden_domicilio',
                'calle' => htmlspecialchars($request->input('calle_fiscal')),
                'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                'numero' => $request->input('numero_fiscal'),
                'dpto' => htmlspecialchars($request->input('dpto_fiscal')),
                'puerta' => htmlspecialchars($request->input('puerta_fiscal')),
                'lote' => htmlspecialchars($request->input('lote_fiscal')),
                'manzana' => htmlspecialchars($request->input('manzana_fiscal')),
                'entre_calles' => htmlspecialchars($request->input('entreCalles_fiscal')),
                'oficina' => htmlspecialchars($request->input('oficina_fiscal')),
                'monoblock' => htmlspecialchars($request->input('monoblock_fiscal')),
                'barrio' => htmlspecialchars($request->input('barrio_fiscal')),
                'id_localidad' => $request->input('localidad_fiscal'),
                'codigo_postal' => htmlspecialchars($request->input('cp_fiscal')),
            ]);
            $proveedor_domicilio_fiscal->save();

            //---------Contador de Telefono_Fiscal----------

            $telefonos_fiscal = Proveedor_telefono::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_telefono', 'fiscal')->get();
            //return $telefonos_fiscal;

            $i = 0;
            foreach ($telefonos_fiscal as $k){
                //return $request->telefono_fiscal[$i];

                $telefono_fiscal = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                $telefono_fiscal->update([
                    'nro_tel' => $request->telefono_fiscal[$i],
                ]);
                $telefono_fiscal->save();
                $i++;

            }

            $arraySize = count($request->telefono_fiscal);
            if($i<2){
                for ($i; $i < $arraySize; $i++) {
                    //---------Carga de Telefonos_Fiscal----------

                    $telefono_fiscal = Proveedor_telefono::create([
                        'nro_tel' => $request->telefono_fiscal[$i],
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        //'cod_area_tel' =>,
                        //'tipo_medio'=>,
                        //'desc_telefono'=>,
                        'tipo_telefono' => 'fiscal',
                        //'nro_orden_telefono'=>,
                    ]);
                    $telefono_fiscal->save();
                }
            }
            //---------Contador de Email_Fiscal----------

            $emails_fiscal = Proveedor_email::where('id_proveedor', $proveedor->id_proveedor)->where('tipo_email', 'fiscal')->get();
            //return $emails_fiscal;
            $i = 0;
            foreach ($emails_fiscal as $j){
                //return $request->email_fiscal[$i];

                $email_fiscal = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                $email_fiscal->update([
                    'email' => $request->email_fiscal[$i],
                ]);
                $email_fiscal->save();
                $i++;

            }


            $arraySize = count($request->email_fiscal);
            if($i<2){


            for ($i; $i < $arraySize ; $i++) {
                $email_fiscal = Proveedor_email::create([
                    'email' => $request->email_fiscal[$i],
                    'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                    'tipo_email' => 'fiscal',
                ]);
                $email_fiscal->save();

             }
            }



            }

            //---------Tipo de Proveedor ----------
            if (isset($request->prov_provincial)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor' ,$proveedor->id_proveedor)->where('id_tipo_proveedor' , '4')->get();
                if($Proveedores_tipos_proveedores->isEmpty()){
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '4',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            }
            else{
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor' , '4')->get();
                if(!$Proveedores_tipos_proveedores->isEmpty()){
                    Proveedores_tipos_proveedores::where('id_proveedor' , $proveedor->id_proveedor)->where('id_tipo_proveedor' , '4')->delete();
                 }

            }

            if (isset($request->prov_estado)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor' ,$proveedor->id_proveedor)->where('id_tipo_proveedor' , '1')->get();
                if($Proveedores_tipos_proveedores->isEmpty()){
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '1',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            }
            else{
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor' , '1')->get();
                if(!$Proveedores_tipos_proveedores->isEmpty()){
                    Proveedores_tipos_proveedores::where('id_proveedor' , $proveedor->id_proveedor)->where('id_tipo_proveedor' , '1')->delete();
                 }

            }

            if (isset($request->prov_minero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor' ,$proveedor->id_proveedor)->where('id_tipo_proveedor' , '2')->get();
                if($Proveedores_tipos_proveedores->isEmpty()){
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '2',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            }
            else{
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor' , '2')->get();
                if(!$Proveedores_tipos_proveedores->isEmpty()){
                    Proveedores_tipos_proveedores::where('id_proveedor' , $proveedor->id_proveedor)->where('id_tipo_proveedor' , '2')->delete();
                 }

            }

            if (isset($request->prov_petrolero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor' ,$proveedor->id_proveedor)->where('id_tipo_proveedor' , '3')->get();
                if($Proveedores_tipos_proveedores->isEmpty()){
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '3',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            }
            else{
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor' , '3')->get();
                if(!$Proveedores_tipos_proveedores->isEmpty()){
                    Proveedores_tipos_proveedores::where('id_proveedor' , $proveedor->id_proveedor)->where('id_tipo_proveedor' , '3')->delete();
                 }

            }



        $proveedores_rupae = Proveedor::find($id);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae = $proveedores_rupae->fill($request->all());
        $proveedores_rupae->valor_agregado = $request->valor_agregado;

        $proveedores_rupae->servicio_atencion_cliente = $request->servicio_atencion_cliente;
        $proveedores_rupae->servicio_post_venta = $request->servicio_post_venta;
        $proveedores_rupae->servicio_personal_especializado = $request->servicio_personal_especializado;
        $proveedores_rupae->servicio_entrega_a_domicilio = $request->servicio_entrega_a_domicilio;
        $proveedores_rupae->servicio_capacitacion_personal = $request->servicio_capacitacion_personal;
        $proveedores_rupae->producto_transformacion_significativa = $request->producto_transformacion_significativa;
        $proveedores_rupae->producto_compra_y_vende_unic = $request->producto_compra_y_vende_unic;
        $proveedores_rupae->producto_post_venta = $request->producto_post_venta;
        $proveedores_rupae->producto_venta_asistida = $request->producto_venta_asistida;
        $proveedores_rupae->producto_garantia = $request->producto_garantia;


        $proveedores_rupae->save();
        return redirect()->back()->withSuccess('Los datos del registro se han modificado satisfactoriamente !');

    }

    public function dar_baja(Request $request)
    {
        $id_proveedor = htmlspecialchars($request->id);
        $proveedores_rupae = Proveedor::find($id_proveedor);
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
        $id_proveedor = htmlspecialchars($request->id);
        $proveedores_rupae = Proveedor::find($id_proveedor);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 1;
        $proveedores_rupae->save();
        return redirect()->back();

    }


    public function dar_alta_id(Request $request)
    {
        $id_proveedor = htmlspecialchars($request->id);
        $proveedores_rupae = Proveedor::find($id_proveedor);
        //return response()->json($proveedores_rupae);
        $proveedores_rupae->dado_de_baja = 0;
        $proveedores_rupae->save();
        return redirect()->back();

    }

    public function getLocalidades($provincia, Request $request)
    {
        //obtenemos el id de la provincia
        $provinciaid = DB::table('provincias')->where('nombre_provincia', $provincia)->first();

        //Obtenemos las localidades de la provincia seleccionada
        $localidades = Localidad::where('id_provincia', $provinciaid->id_provincia)->orderby('nombre_localidad', 'asc')->get();

        //Calculamos el tamaño de las localidades
        $max = sizeof($localidades);

        //var_dump(json_decode(json_encode($localidades[0]["nombre_localidad"])));

        $select = '';

        for ($i = 0; $i < $max; $i++) {
            $select = $select . '<option value=' . $localidades[$i]["id_localidad"] . '>' . $localidades[$i]["nombre_localidad"] . '</option>';
        }

        return $select;
    }

    public function getLocalidadSelect($id, Request $request)
    {
        //obtenemos el id de la provincia

        $provinciaid = Localidad::where('id_localidad', $id)->get();
        $provinciaid = $provinciaid[0]->id_provincia;


   //Obtenemos las localidades de la provincia seleccionada
   $localidades = Localidad::where('id_provincia', $provinciaid)->orderby('nombre_localidad', 'asc')->get();

   //Calculamos el tamaño de las localidades
   $max = sizeof($localidades);

   //var_dump(json_decode(json_encode($localidades[0]["nombre_localidad"])));

   $select = '';

   for ($i = 0; $i < $max; $i++) {
       if ($localidades[$i]["id_localidad"] == $id) {
           $select = $select . '<option selected="selected" value=' . $localidades[$i]["id_localidad"] . '>' . $localidades[$i]["nombre_localidad"] . '</option>';
       } else {
           $select = $select . '<option value=' . $localidades[$i]["id_localidad"] . '>' . $localidades[$i]["nombre_localidad"] . '</option>';
       }

   }

   return $select;
    }

/*
public function getLocalidadesTabla($provincia, Request $request)
{
//obtenemos el id de la provincia
$provinciaid = DB::table('provincias')->where('nombre_provincia', $provincia)->first();

//Obtenemos las localidades de la provincia seleccionada
$localidades = Localidad::where('id_provincia', $provinciaid->id_provincia)->orderby('nombre_localidad', 'asc')->get();

//Calculamos el tamaño de las localidades
$max = sizeof($localidades);

//var_dump(json_decode(json_encode($localidades[0]["nombre_localidad"])));

$select = '';

for ($i = 0; $i < $max; $i++) {
$select = $select . '<option value=' . $localidades[$i]["nombre_localidad"] . '>' . $localidades[$i]["nombre_localidad"] . '</option>';
}

return $select;
}
 */

    public function actualizar_formulas(Request $request)
    {
        try{

            $facturacion = Ponderacion_compre_local::find(1);
            $facturacion->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_facturacion),
            ]);

            $gastos = Ponderacion_compre_local::find(2);
            $gastos->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_gastos),
            ]);

            $mano_obra = Ponderacion_compre_local::find(3);
            $mano_obra->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_obra),
            ]);


            $antiguedad = Ponderacion_compre_local::find(4);
            $antiguedad->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_antiguedad),
            ]);

            $domicilio = Ponderacion_compre_local::find(5);
            $domicilio->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_domicilio),
            ]);

            $valor_agregado = Ponderacion_compre_local::find(6);
            $valor_agregado->update([
                'valor_ponderacion' => htmlspecialchars($request->actualizar_agregado),
            ]);



            $local = Jerarquia_compre_local::find(1);
            $local->update([
                'valor_desde' => htmlspecialchars($request->local_inicial),
                'valor_hasta' => htmlspecialchars($request->local_final),
            ]);

            $intermedio = Jerarquia_compre_local::find(2);
            $intermedio->update([
                'valor_desde' => htmlspecialchars($request->intermedio_inicial),
                'valor_hasta' => htmlspecialchars($request->intermedio_final),
            ]);

            $foraneo = Jerarquia_compre_local::find(3);
            $foraneo->update([
                'valor_desde' => htmlspecialchars($request->foraneo_inicial),
                'valor_hasta' => htmlspecialchars($request->foraneo_final),
            ]);

            return redirect()->back()->withSuccess('Los valores de las fórmulas se han actualizado satisfactoriamente.');

        } catch(\Illuminate\Database\QueryException $ex){ 
            //dd($ex->getMessage());
            $message = "Los valores introducidos en los campos de Ponderación deben ser menores a 10.";
            return redirect()->back()->withErrors($message);
        }

    }

}
