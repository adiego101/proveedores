<?php

namespace App\Http\Controllers;

use App\Models\Actividades_proveedores;
use App\Models\Actividad_economica;
use App\Models\Jerarquia_compre_local;
use App\Models\Localidad;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\Ponderacion_compre_local;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Proveedores_tipos_proveedores;
use App\Models\Proveedor_domicilio;
use App\Models\Proveedor_email;
use App\Models\Proveedor_patente;
use App\Models\Proveedor_sede;
use App\Models\Proveedor_seguro;
use App\Models\Proveedor_telefono;
use App\Models\Provincia;
use App\Models\Sucursal;
use App\Models\Sucursal_email;
use App\Models\Sucursal_telefono;
use App\Models\Tipo_actividad;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    //Carga Completa de Proveedor
    public function crear_registro(Request $request)
    {

        //try{
        $cuit = Proveedor::where('cuit', $request->cuit)->exists();
        $dado_de_baja = Proveedor::where('cuit', $request->cuit)->where('dado_de_baja', '0')->get();
        //return $dado_de_baja->isEmpty();
        //return empty($dado_de_baja);
        //return $cuit;
        if (!$cuit || $dado_de_baja->isEmpty()) {

            $id_tamanio_empresa = $request->id_tamanio_empresa;

            //-------------------Carga Proveedor-------------------
            //return $request->input('retencion');
            $proveedores_rupae = new Proveedor($request->all());
            $proveedores_rupae->id_tamanio_empresa = $id_tamanio_empresa;

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
                'calle' => $request->input('calle_real'),
                'id_proveedor' => $proveedores_rupae->id_proveedor,
                'numero' => $request->input('numero_real'),
                'dpto' => $request->input('dpto_real'),
                'puerta' => $request->input('puerta_real'),
                'lote' => $request->input('lote_real'),
                'manzana' => $request->input('manzana_real'),
                'entre_calles' => $request->input('entreCalles_real'),
                'oficina' => $request->input('oficina_real'),
                'monoblock' => $request->input('monoblock_real'),
                'barrio' => $request->input('barrio_real'),
                'id_localidad' => $request->input('localidad_real'),
                'codigo_postal' => $request->input('cp_real'),
            ]);
            $domicilio_real->save();

            //---------Contador de Telefono_Real----------

            $arraySize = count($request->telefono_real);

            for ($i = 0; $i < $arraySize; $i++) {
                //---------Carga de Telefonos_Real----------

                $telefono_real = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_real[$i],
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'tipo_email' => 'real',
                ]);
                $email_real->save();
            }

            //----------------------------------Carga Domicilio Legal---------------------------------------------

            $domicilio_legal = Proveedor_domicilio::create([
                'tipo_domicilio' => 'legal',
                'id_proveedor' => $proveedores_rupae->id_proveedor,

                //'nro_orden_domicilio',
                'calle' => $request->input('calle_legal'),
                'numero' => $request->input('numero_legal'),
                'lote' => $request->input('lote_legal'),
                'entre_calles' => $request->input('entreCalles_legal'),
                'monoblock' => $request->input('monoblock_legal'),
                'dpto' => $request->input('dpto_legal'),
                'puerta' => $request->input('puerta_legal'),
                'oficina' => $request->input('oficina_legal'),
                'manzana' => $request->input('manzana_legal'),
                'barrio' => $request->input('barrio_legal'),
                'codigo_postal' => $request->input('cp_legal'),
                'id_localidad' => $request->input('localidad_legal'),

            ]);
            $domicilio_legal->save();
            //---------Contador de Telefono_Legal----------

            $arraySize = count($request->telefono_legal);

            //---------Carga de Telefonos_Legal----------

            for ($i = 0; $i < $arraySize; $i++) {

                $telefono_legal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_legal[$i],
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
                    'tipo_email' => 'legal',
                ]);
                $email_legal->save();
            }

            $Representante_legal = Persona::create([
                'dni_persona' => $request->dni_legal,
                //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                'nombre_persona' => $request->representante_legal,
                //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                //'genero_persona'=>$proveedores_rupae->genero_persona,
            ]);
            $Representante_legal->save();

            $proveedores_rupae->personas()->attach($Representante_legal);

            //----------------------------------Carga Domicilio Fiscal---------------------------------------------

            $domicilio_fiscal = Proveedor_domicilio::create([
                'tipo_domicilio' => 'fiscal',
                'id_proveedor' => $proveedores_rupae->id_proveedor,
                //'nro_orden_domicilio',
                'calle' => $request->input('calle_fiscal'),
                'numero' => $request->input('numero_fiscal'),
                'lote' => $request->input('lote_fiscal'),
                'entre_calles' => $request->input('entreCalles_fiscal'),
                'monoblock' => $request->input('monoblock_fiscal'),
                'dpto' => $request->input('dpto_fiscal'),
                'puerta' => $request->input('puerta_fiscal'),
                'oficina' => $request->input('oficina_fiscal'),
                'manzana' => $request->input('manzana_fiscal'),
                'barrio' => $request->input('barrio_fiscal'),
                'id_localidad' => $request->input('localidad_fiscal'),
                'codigo_postal' => $request->input('cp_fiscal'),
            ]);
            $domicilio_fiscal->save();
            //---------Contador de Telefono_Fiscal----------

            $arraySize = count($request->telefono_fiscal);

            //---------Carga de Telefonos_Fiscal----------

            for ($i = 0; $i < $arraySize; $i++) {
                $telefono_fiscal = Proveedor_telefono::create([
                    'nro_tel' => $request->telefono_fiscal[$i],
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                    'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                    $sucursal->codigo_postal = $request->codigo_postal[$i];
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
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
                        'id_proveedor' => $proveedores_rupae->id_proveedor,
                        'fecha' => $request->fechas_pagos[$i],
                        'importe' => $request->importes_pagos[$i],
                        'observaciones' => $request->observaciones_pagos[$i],

                    ]);
                    $Pago->save();
                }
            }

            return redirect()->back()->with('message', 'Registro Creado Correctamente');
        } else {
            return Redirect::back()
                ->withErrors(['El Cuil Ingresado ya existe, la operación no pudo completarse']);}
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
                    $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaRegistro(' . $row->id_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getSucursales(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Sucursal::where('id_proveedor', $id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = url('editarSucursales/' . $row->id_sucursal);

                    $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaSucursal(' . $row->id_sucursal . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function editarSucursales($id)
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
        return view('ediciones.sucursales', compact('provinciaid','sucursal', 'sucursal_email', 'sucursal_telefono','paises','provincias','localidades'));

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
        $sucursal_email = Sucursal_email::where('id_sucursal', $id)->firstOrFail();

        $sucursal_email->update([
            'email' => $request->email,
        ]);

        $sucursal_email->save();

        $sucursal_telefono = Sucursal_telefono::where('id_sucursal', $id)->firstOrFail();
        $sucursal_telefono->update([
            'nro_tel' => $request->nro_tel,
        ]);
        $sucursal_telefono->save();

        $sucursal = $sucursal->fill($request->all());
        $sucursal->save();
        return redirect()->back();

    }

    public function getPagos(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Pago::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarPagos/' . $row->id_pagos);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaPago(' . $row->id_pagos . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }
    public function editarPagos($id)
    {
        $pago = Pago::where('id_pagos', $id)->get();

        return view('ediciones.pagos', (['pago' => $pago[0]]));

    }

    public function guardarPagos($id, Request $request)
    {
        $pago = Pago::find($id);

        $pago = $pago->fill($request->all());
        $pago->save();
        return redirect()->back();

    }

    public function bajaPagos($id)
    {
        $pago = Pago::findOrFail($id)->delete();

        return "success";

    }

    public function getActividades(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Actividades_proveedores::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarActividades/' . $row->id_actividad_proveedor);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaActividad(' . $row->id_actividad_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
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
        return view('ediciones.actividades', compact('actividad', 'tipos_actividades', 'actividades'));

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

            return redirect()->back();
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

            return redirect()->back();
        }


    }

    public function getProductos(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Producto::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarProductos/' . $row->id_producto);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaProducto(' . $row->id_producto . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
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

        return view('ediciones.producto', compact('producto','productos'));

    }

    public function bajaProductos($id)
    {
        Producto::findOrFail($id)->delete();
        return "success";
    }

    public function guardarProductos($id, Request $request)
    {
        $producto = Producto::find($id);

        $producto = $producto->fill($request->all());
        $productos = Producto::All();

        $producto->save();
        return redirect()->back();

    }

    public function getPatentes(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Proveedor_patente::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarPatentes/' . $row->id_proveedor_patente);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaPatente(' . $row->id_proveedor_patente . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarPatentes($id)
    {
        $patente = Proveedor_patente::where('id_proveedor_patente', $id)->get();
        $patente = $patente[0];
        return view('ediciones.patentes', compact('patente'));

    }

    public function bajaPatentes($id)
    {
        Proveedor_patente::findOrFail($id)->delete();
        return "success";
    }

    public function guardarPatentes($id, Request $request)
    {
        $patente = Proveedor_patente::find($id);

        $patente = $patente->fill($request->all());
        $patente->save();
        return redirect()->back();

    }

    public function getSeguros(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Proveedor_seguro::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarSeguros/' . $row->id_proveedor_seguro);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaSeguro(' . $row->id_proveedor_seguro . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function editarSeguros($id)
    {
        $seguro = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
        $seguro = $seguro[0];
        return view('ediciones.seguros', compact('seguro'));

    }

    public function bajaSeguros($id)
    {
        Proveedor_seguro::findOrFail($id)->delete();
        return "success";
    }

    public function guardarSeguros($id, Request $request)
    {
        $seguro = Proveedor_seguro::find($id);

        $seguro = $seguro->fill($request->all());
        $seguro->save();
        return redirect()->back();

    }

    public function getSedes(Request $request, $id)
    {
        //if ($request->ajax()) {
        $data = Proveedor_sede::where('id_proveedor', $id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = url('editarSedes/' . $row->id_proveedor_sede);

                $actionBtn = '<a href="' . "$url" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a onclick="verRegistro();" class="view btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaSede(' . $row->id_proveedor_sede . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                return $actionBtn;
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
        $provinciaid = $provinciaid[0]->id_provincia;
        return view('ediciones.sedes', compact('sede','provincias','localidades','paises','provinciaid'));

    }

    public function bajaSedes($id)
    {
        Proveedor_sede::findOrFail($id)->delete();
        return "success";
    }

    public function guardarSedes($id, Request $request)
    {
        $sede = Proveedor_sede::find($id);

        $sede = $sede->fill($request->all());
        $sede->save();
        return redirect()->back();

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

    public function obtenerProveedorRupaeId($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $persona = $proveedor->personas()->get();
        $persona = $persona[0];
        //return $persona;
        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

        $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();

        $provinciaidFiscal =  $provinciaidFiscal[0]->id_provincia;

        $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
            ->get();

        //return $proveedor_email_fiscal;

        $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
            ->get();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        $provinciaidLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

        $provinciaidLegal =  $provinciaidLegal[0]->id_provincia;

        $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
            ->get();

        $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
            ->get();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();

        $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

        $provinciaidReal =  $provinciaidReal[0]->id_provincia;

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

        return view('editarRegistro', compact('persona', 'mode',
        'provinciaidReal','provinciaidLegal','provinciaidFiscal','paises', 'jerarquias', 'provincias','localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones','proveedor',
        'id' ,'proveedor_telefono_fiscal','proveedor_domicilio_fiscal' ,'proveedor_email_fiscal' ,'proveedor_telefono_legal' ,'proveedor_domicilio_legal' ,
        'proveedor_email_legal' ,'proveedor_telefono_real' ,'proveedor_domicilio_real' ,'proveedor_email_real' ,'proveedores_tipos_proveedores',
        'sucursales', 'actividades' ,'productos' ,'patentes' ,'seguros' , 'sedes', 'pagos')
        );
    }

    public function verProveedorRupaeId($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $persona = $proveedor->personas()->get();
        $persona = $persona[0];
        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

        $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();

        $provinciaidFiscal =  $provinciaidFiscal[0]->id_provincia;

        $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
            ->get();

        $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
            ->get();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        $provinciaidLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

        $provinciaidLegal =  $provinciaidLegal[0]->id_provincia;

        $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
            ->get();

        $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
            ->get();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
            ->first();

        $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

        $provinciaidReal =  $provinciaidReal[0]->id_provincia;

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


        return view('verRegistro', compact('persona', 'mode',
        'provinciaidReal','provinciaidLegal','provinciaidFiscal','paises', 'jerarquias', 'provincias','localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones','proveedor',
        'id' ,'proveedor_telefono_fiscal','proveedor_domicilio_fiscal' ,'proveedor_email_fiscal' ,'proveedor_telefono_legal' ,'proveedor_domicilio_legal' ,
        'proveedor_email_legal' ,'proveedor_telefono_real' ,'proveedor_domicilio_real' ,'proveedor_email_real' ,'proveedores_tipos_proveedores',
        'sucursales', 'actividades' ,'productos' ,'patentes' ,'seguros' , 'sedes', 'pagos')
        );
    }

    public function editarProveedor($id, Request $request)
    {
        $proveedor = Proveedor::findOrFail($id)->with('sucursales')->get();
        $persona = $proveedor->personas()->get();
        $persona = $persona[0];

        $proveedor_email = DB::table('proveedores_emails')
            ->where('id_proveedor', $id)
            ->first();

        $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
            ->first();

        $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
            ->first();

        $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
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
}
