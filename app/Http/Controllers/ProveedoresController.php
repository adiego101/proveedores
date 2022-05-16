<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProveedoresController;
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
use App\Models\Proveedor_palabra_clave;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\User;

class ProveedoresController extends Controller
{

    public function idLocalidad($nombre_localidad)
    {
        try {
            $id_localidad = Localidad::where('nombre_localidad', $nombre_localidad)->get();
            $id_localidad = $id_localidad[0]->id_localidad;
            return $id_localidad;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function idtipos_actividades($nombre_tipos_actividades)
    {
        try {
            $id_tipos_actividades = Tipo_actividad::where('desc_tipo_actividad', $nombre_tipos_actividades)->get();
            $id_tipos_actividades = $id_tipos_actividades[0]->id_tipo_actividad;
            return $id_tipos_actividades;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function idActividad_economica($nombre_actividad)
    {
        try {
            $id_Actividad_economica = Actividad_economica::where('desc_actividad', $nombre_actividad)->get();
            $id_Actividad_economica = $id_Actividad_economica[0]->id_actividad_economica;
            return $id_Actividad_economica;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function crear_registro_cuit(Request $request)
    {
        try {
            $cuit = Proveedor::where('cuit', str_replace("-","",$request->cuit))->exists();

            $dado_de_baja = Proveedor::where('cuit', str_replace("-","",$request->cuit))->get();
            //dd($dado_de_baja[0]['dado_de_baja']);

            /*Primero verificamos si el cuit NO existe en la BD. En este caso, lo redirijimos al usuario al formulario de alta.*/
            if (!$cuit) {

                return redirect()->route('nuevoRegistro', ['cuit' => $request->cuit]);

            } else {

                /*Sino, si el cuit existe en la BD, verificamos si no esta dado de baja.
                Si no esta dado de baja, recuperamos los datos y redirijimos al usuario al formulario de editar.
                En el caso de que se encuentre dado de baja, mostramos un mensaje de aviso.*/

                if ($dado_de_baja[0]['dado_de_baja'] == 0) {

                    $proveedor = Proveedor::where('cuit', str_replace("-","",$request->cuit))->first();

                    return redirect()->route('modificarRegistro', ['id' => $proveedor->id_proveedor]);

                } else {

                    return redirect()->back()->withErrors("El registro con el número de CUIT: " . $request->cuit . " se encuentra dado de baja. Si desea modificar sus datos, vaya a la pestaña 'Gestionar Registros' para darlo de alta nuevamente.");
                }

            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    //Carga Completa de Proveedor
    public function crear_registro(Request $request)
    {
        try {



            $cuit = Proveedor::where('cuit', str_replace("-","",$request->cuit))->exists();
            $dado_de_baja = Proveedor::where('cuit', str_replace("-","",$request->cuit))->where('dado_de_baja', '0')->get();
            //return $dado_de_baja->isEmpty();
            //return empty($dado_de_baja);
            //return $cuit;
            if (!$cuit/*|| $dado_de_baja->isEmpty()*/) {


                //-------------------Carga Proveedor-------------------

                //Inicio de la transaccion
            DB::beginTransaction();


                    //-------------------Carga Proveedor-------------------
                    $proveedores_rupae = new Proveedor($request->all());
                    $proveedores_rupae->cuit= str_replace("-","",$request->cuit);

                    if(isset($proveedores_rupae->masa_salarial_bruta)){

                        $proveedores_rupae->masa_salarial_bruta= str_replace(",",".",str_replace(".","",$request->masa_salarial_bruta));
                        
                    } else {

                        $proveedores_rupae->masa_salarial_bruta= $request->masa_salarial_bruta;
                    }

                    
                    if(isset($proveedores_rupae->facturacion_anual_alcanzada)){

                        $proveedores_rupae->facturacion_anual_alcanzada= str_replace(",",".",str_replace(".","",$request->facturacion_anual_alcanzada));

                    } else {

                        $proveedores_rupae->facturacion_anual_alcanzada= $request->facturacion_anual_alcanzada;
                    }

                    $proveedores_rupae->save();


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
                            'cod_area_tel' => $request->telefono_real_cod[$i],
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
                            'cod_area_tel' => $request->telefono_legal_cod[$i],
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

                    /*
                    $Representante_legal = Persona::where('dni_persona',htmlspecialchars($request->dni_legal))
                                                ->fierst();
                    if(!$Representante_legal){
                        $Representante_legal = Persona::create([
                            'dni_persona' => htmlspecialchars($request->dni_legal),
                            //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                            'nombre_persona' => htmlspecialchars($request->nombre_persona),
                            'apellido_persona' => htmlspecialchars($request->apellido_persona),
                            //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                            //'genero_persona'=>$proveedores_rupae->genero_persona,
                        ]);

                        $Representante_legal->save();
                    }*/

                    $Representante_legal = Persona::create([
                         

                        'dni_persona' => htmlspecialchars(str_replace(".","",$request->dni_legal)),
                        //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                        'nombre_persona' => htmlspecialchars($request->nombre_persona),
                        'apellido_persona' => htmlspecialchars($request->apellido_persona),
                        //'apellido_persona'=>$proveedores_rupae->apellido_persona,
                        //'genero_persona'=>$proveedores_rupae->genero_persona,
                    ]);

                    $Representante_legal->save();


                    $proveedores_rupae->personas()->attach($Representante_legal, ['rol_persona_proveedor' => 'Representante']);

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
                            'cod_area_tel' => $request->telefono_fiscal_cod[$i],
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
                            if (isset($request->Telefonos_sucursales) && isset($request->telefonos_cod_sucursales)) {

                                $sucursal_telefono = new Sucursal_telefono();
                                $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
                                $sucursal_telefono->nro_tel = $request->Telefonos_sucursales[$i];
                                $sucursal_telefono->cod_area_tel = $request->telefonos_cod_sucursales[$i];
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


                    //---------Contador de Palabras claves----------
                    if (isset($request->palabras_claves)) {

                        $arraySize = count($request->palabras_claves);

                        for ($i = 0; $i < $arraySize; $i++) {
                            //---------Carga de Palabras claves----------

                            $palabra_clave = Proveedor_palabra_clave::create([
                                'id_proveedor' => htmlspecialchars($proveedores_rupae->id_proveedor),
                                'desc_palabra_clave' => $request->palabras_claves[$i],

                            ]);

                            $palabra_clave->save();
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
                                'domicilio' => $request->domicilios_sedes[$i],
                                'id_localidad' => $request->localidades_sedes[$i],
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
                                'tipo_pago' => $request->tipos_pagos[$i],
                                'observaciones' => $request->observaciones_pagos[$i],

                            ]);
                            $Pago->save();
                        }
                    }

                //Fin de la transaccion
                DB::commit();


                //Registro de LOG
                $responsable_id = User::findOrFail(auth()->id())->id;
                $responsable_nombre = User::findOrFail(auth()->id())->name;
                $responsable_email = User::findOrFail(auth()->id())->email;

                DB::connection('mysql')
                ->table('eventos_log')->insert(['EL_Evento' => 'Se ha creado un nuevo registro con el cuit: ' . $request->cuit . '.',
                'EL_Evento_Fecha' => Carbon::now(),
                'EL_Id_Responsable' => $responsable_id,
                'EL_Nombre_Responsable' => $responsable_nombre,
                'EL_Email_Responsable' => $responsable_email]);


                return redirect()->route('verRegistro', ['id' => $proveedores_rupae->id_proveedor])->with('message', 'Registro creado correctamente');



            } else {

                    $proveedor = Proveedor::where('cuit', str_replace("-","",$request->cuit))->first();

                    return redirect()->route('modificarRegistro', ['id' => $proveedor->id_proveedor]);

                }
        } catch (\Exception$e) {

            //Si algo fallo, volvemos atras la transaccion
            DB::rollBack();

            Log::error('Error inesperado.' . $e->getMessage());
            $request->flash();
            $data = $request->session()->all();
            Log::info('Datos de la sesion: '. print_r($data, true));
            return redirect()->back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse'])
                ->withInput();
        }

    }


    /*
    Funcion que devuelve un listado de proveedores almacenados en la BD (Datatable)
    junto a los botones para editar, ver y dar de baja un registro
     */
    public function getProveedores(Request $request)
    {
        try {
            if ($request->ajax()) {

                $data = Proveedor::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        if ($row->dado_de_baja == 0) {
                            $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaRegistro(' . $row->id_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                        } else {

                            //BOTON ELIMINAR REGISTRO COMENTADO

                            /*$actionBtn = '<button class="edit btn btn-warning btn-sm" title="Editar" disabled><i class="fas fa-edit"></i></button> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="altaRegistro(' . $row->id_proveedor . ');" class="alta btn btn-success btn-sm" title="Dar de alta"><i class="fas fa-arrow-alt-circle-up"></i></a> <a onclick="eliminarRegistro(' . $row->id_proveedor . ');" class="eliminar btn btn-outline-danger btn-sm" title="Eliminar">X</a>';*/

                            $actionBtn = '<button class="edit btn btn-warning btn-sm" title="Editar" disabled><i class="fas fa-edit"></i></button> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="altaRegistro(' . $row->id_proveedor . ');" class="alta btn btn-success btn-sm" title="Dar de alta"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                        }

                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSucursales(Request $request, $id, $mode)
    {
        try {
            if ($request->ajax()) {
                $data = Sucursal::with(['telefonos', 'emails'])
                    ->where('id_proveedor', $id)
                    ->get();
                Log::info('sucursal editar' . $data);
                if ($request->ajax()) {

                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) use ($mode) {
                            $url = url('editarSucursales/' . $row->id_sucursal);
                            $url2 = url('verSucursales/' . $row->id_sucursal);

                            if ($mode == "show") {
                                $actionBtn = ' <a class="view_sucursal btn btn-primary btn-sm" title="Ver" data-toggle="modal" data-id_proveedor="' . $row->id_proveedor . '" data-id_sucursal="' . $row->id_sucursal . '">
                        <i class="fas fa-eye"></i>
                    </a>';
                                return $actionBtn;
                            } else {
                                $actionBtn = '<a class="edit_sucursal btn btn-warning btn-sm" title="Editar" data-toggle="modal" data-id_proveedor="' . $row->id_proveedor . '" data-id_sucursal="' . $row->id_sucursal . '">
                                        <i class="fas fa-edit"></i>
                                    </a>
                        <a onclick="bajaSucursal(' . $row->id_sucursal . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                                return $actionBtn;
                            }

                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSucursalesBD($id)
    {
        try {
            $proveedor = Proveedor::findOrFail($id);
            return $proveedor->sucursales;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarSucursales($id_sucursal)
    {
        try {

            $sucursal = Sucursal::where('id_sucursal', '=', $id_sucursal)
                ->with(['localidad', 'telefonos', 'emails'])
                ->first();
            $mode = "edit";
            $paises = Pais::orderBy('nombre_pais', 'ASC')
                ->get();
            $provincias = Provincia::orderBy('nombre_provincia', 'ASC')
                ->get();
            $localidades = Localidad::orderBy('nombre_localidad', 'ASC')
                ->whereHas('provincia', function ($query) use ($sucursal) {
                    $query->where('nombre_provincia', '=', $sucursal->localidad->provincia->nombre_provincia);
                })
                ->get();
            return (String) view('sucursales.form', compact('mode', 'paises', 'provincias', 'localidades', 'sucursal'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }
    public function verSucursales($id_sucursal)
    {
        try {

            $sucursal = Sucursal::where('id_sucursal', '=', $id_sucursal)
                ->with(['localidad', 'telefonos', 'emails'])
                ->first();
            $mode = "show";
            $paises = Pais::orderBy('nombre_pais', 'ASC')
                ->get();
            $provincias = Provincia::orderBy('nombre_provincia', 'ASC')
                ->get();
            $localidades = Localidad::orderBy('nombre_localidad', 'ASC')
                ->whereHas('provincia', function ($query) use ($sucursal) {
                    $query->where('nombre_provincia', '=', $sucursal->localidad->provincia->nombre_provincia);
                })
                ->get();
            return (String) view('sucursales.form', compact('mode', 'paises', 'provincias', 'localidades', 'sucursal'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verSucursales3($id)
    {
        try {
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

            return view('ediciones.sucursales', compact('provinciaid', 'mode', 'sucursal', 'sucursal_email', 'sucursal_telefono', 'paises', 'provincias', 'localidades'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaSucursales($id)
    {
        try {
            Sucursal_email::where('id_sucursal', $id)->delete();
            Sucursal_telefono::where('id_sucursal', $id)->delete();
            Sucursal::findOrFail($id)->delete();

            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function guardarSucursales($id, Request $request)
    {
        try {
            $sucursal = Sucursal::find($id);

            $sucursal_email = Sucursal_email::where('id_sucursal', $id)->first();
            //return response()->json($sucursal_email);
            if (!empty($sucursal_email)) {
                $sucursal_email->update([
                    'email' => $request->email_sucursales,
                ]);

                $sucursal_email->save();
            } else {
                //----------------Carga de email Sucursal---------------
                if (isset($request->email_sucursales)) {
                    $sucursal_email = new Sucursal_email();
                    $sucursal_email->id_sucursal = $sucursal->id_sucursal;
                    $sucursal_email->email = $request->email_sucursales;
                    $sucursal_email->save();
                    //$sucursal->save($sucursal_email);
                }
            }
            $sucursal_telefono = Sucursal_telefono::where('id_sucursal', $id)->first();

            if (!empty($sucursal_telefono)) {
                $sucursal_telefono->update([
                    'nro_tel' => $request->telefono_sucursal,
                    'cod_area_tel' => $request->telefono_sucursal_cod,

                ]);
                $sucursal_telefono->save();
            } else {
                //----------------Carga de telefono Sucursal---------------
                if (isset($request->telefono_sucursal)) {

                    $sucursal_telefono = new Sucursal_telefono();
                    $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
                    $sucursal_telefono->nro_tel = $request->telefono_sucursal;
                    $sucursal_telefono->cod_area_tel = $request->telefono_sucursal_cod;

                    $sucursal_telefono->save();
                }
            }

            $sucursal = $sucursal->fill($request->all());
            $sucursal->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function crearSucursales($id, Request $request)
    {
        try {
            //----------------Carga de Sucursal---------------

            $sucursal = new Sucursal($request->all());
            $sucursal->id_proveedor = $id;
            $sucursal->save();

            //----------------Carga de email Sucursal---------------
            if (isset($request->email_sucursales)) {
                $sucursal_email = new Sucursal_email();
                $sucursal_email->id_sucursal = $sucursal->id_sucursal;
                $sucursal_email->email = $request->email_sucursales;
                $sucursal_email->save();
            }
            //----------------Carga de telefono Sucursal---------------
            if (isset($request->telefono_sucursal)) {

                $sucursal_telefono = new Sucursal_telefono();
                $sucursal_telefono->id_sucursal = $sucursal->id_sucursal;
                $sucursal_telefono->nro_tel = $request->telefono_sucursal;
                $sucursal_telefono->cod_area_tel = $request->telefono_sucursal_cod;
                $sucursal_telefono->save();
            }
            $sucursal->save();
            return redirect()->back()->with('message', 'Sucursal Creada Correctamente');
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoSucursales($id)
    {
        try {
            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $mode = "create";

            return view('ediciones.sucursales', compact('id', 'mode', 'paises', 'provincias', 'localidades'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function getPagos(Request $request, $id, $mode = null)
    {
        try {
            $data = Pago::where('id_proveedor', $id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarPagos/' . $row->id_pagos);
                    $url2 = url('verPagos/' . $row->id_pagos);

                    if ($mode == "show") {
                        $actionBtn = '
                    <a onclick="verPago(' . $row->id_pagos . ');" class="view btn btn-primary btn-sm" title="ver pago">
                    <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '
                    <a onclick="verPago(' . $row->id_pagos . ');" class="view btn btn-warning btn-sm" title="editar pago">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaPago(' . $row->id_pagos . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }
    public function editarPagos($id)
    {
        try {
            $pago = Pago::where('id_pagos', $id)->get();
            $mode = "edit";

            return view('ediciones.pagos', compact('mode'), (['pago' => $pago[0]]));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verPagos($id)
    {
        try {
            $pago = Pago::where('id_pagos', $id)->get();
            $mode = "show";

            return $pago;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function guardarPagos($id, Request $request)
    {
        try {
            $pago = Pago::find($id);
            $pago->importe = $request->importeeditar;
            $pago->fecha = $request->fechaeditar;
            $pago->tipo_pago = $request->tipo_pago_editar;
            $pago->observaciones = $request->observacionespagoeditar;

            $pago = $pago->fill($request->all());
            $pago->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function crearPagos($id, Request $request)
    {
        try {

            $pago = new Pago($request->all());

            $pago->id_proveedor = $id;
            $pago->observaciones = $request->observacionespago;
            $pago->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function nuevoPagos($id)
    {
        try {
            $mode = "create";

            return view('ediciones.pagos', compact('id', 'mode'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function bajaPagos($id)
    {
        try {
            $pago = Pago::findOrFail($id)->delete();

            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function getActividades(Request $request, $id, $mode = null)
    {
        try {
            $data = Actividades_proveedores::where('id_proveedor', $id)
                ->join('actividades_economicas', 'actividades_proveedores.id_actividad_economica', '=', 'actividades_economicas.id_actividad_economica')
                ->join('tipos_actividades', 'actividades_proveedores.id_tipo_actividad', '=', 'tipos_actividades.id_tipo_actividad')
                ->select('actividades_proveedores.id_actividad_economica', 'actividades_proveedores.id_actividad_proveedor', 'actividades_proveedores.id_tipo_actividad', 'actividades_economicas.desc_actividad', 'actividades_economicas.cod_actividad', 'tipos_actividades.desc_tipo_actividad')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarActividades/' . $row->id_actividad_proveedor);
                    $url2 = url('verActividades/' . $row->id_actividad_proveedor);
                    if ($mode == "show") {
                        $actionBtn = ' <a onclick="verActividad(' . $row->id_actividad_proveedor . ');" class="view btn btn-primary btn-sm" title="ver producto">
                    <i class="fas fa-eye"></i></a>  ';
                        return $actionBtn;} else {
                        $actionBtn = '<a onclick="verActividad(' . $row->id_actividad_proveedor . ');" class="view btn btn-warning btn-sm" title="editar producto">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaActividad(' . $row->id_actividad_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarActividades($id)
    {
        try {
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();
            $actividad = Actividades_proveedores::where('id_actividad_proveedor', $id)->get();
            $actividad = $actividad[0];
            $mode = "edit";

            return view('ediciones.actividades', compact('mode', 'actividad', 'tipos_actividades', 'actividades'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verActividades($id)
    {
        try {
            $actividad = Actividades_proveedores::where('id_actividad_proveedor', $id)
                ->join('actividades_economicas', 'actividades_proveedores.id_actividad_economica', '=', 'actividades_economicas.id_actividad_economica')
                ->join('tipos_actividades', 'actividades_proveedores.id_tipo_actividad', '=', 'tipos_actividades.id_tipo_actividad')
                ->select('actividades_proveedores.id_actividad_economica', 'actividades_proveedores.id_actividad_proveedor', 'actividades_proveedores.id_tipo_actividad', 'actividades_economicas.desc_actividad', 'actividades_economicas.cod_actividad', 'tipos_actividades.desc_tipo_actividad')
                ->get();
            $actividad = $actividad[0];
            $mode = "show";

            return $actividad;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function crearActividades($id, Request $request)
    {
        try {
            if ($request->tipo_actividad == "Primaria") {
                if (Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {

                    return Redirect::back()
                        ->withErrors(['Ya existe una actividad primaria, la operación no pudo completarse']);
                } else {

                    $actividad = new Actividades_proveedores();
                    $actividad->id_proveedor = $id;
                    $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
                    $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

                    $actividad->save();

                    return redirect()->back()->with('message', 'Actividad Creada Correctamente');
                }
            } else {

                $actividad = new Actividades_proveedores();
                $actividad->id_proveedor = $id;
                $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
                $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

                $actividad->save();

                return redirect()->back()->with('message', 'Actividad Creada Correctamente');
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoActividades($id)
    {
        try {
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();
            $mode = "create";

            return view('ediciones.actividades', compact('id', 'actividades', 'tipos_actividades', 'mode'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaActividades($id)
    {
        try {
            if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
                return false;
            } else {
                Actividades_proveedores::findOrFail($id)->delete();
                return "success";
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function guardarActividades($id, Request $request)
    {
        try {
            if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
                $actividad = Actividades_proveedores::find($id);
                $tipos_actividades = Tipo_actividad::All();
                $actividades = Actividad_economica::All();

                $actividad->update([
                    'id_actividad_economica' => $this->idActividad_economica($request->actividad_11),
                ]);

                $actividad->save();

                return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');

            } else {

                $actividad = Actividades_proveedores::find($id);
                $tipos_actividades = Tipo_actividad::All();
                $actividades = Actividad_economica::All();

                $actividad->update([
                    'id_actividad_economica' => $this->idActividad_economica($request->actividad_11),
                ]);

                $actividad->save();

                return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function getPalabrasClave(Request $request, $id, $mode = null)
    {
        try {
            $data = Proveedor_palabra_clave::where('id_proveedor', $id)
                ->select('proveedores_palabras_claves.id_proveedor', 'proveedores_palabras_claves.id_proveedor_palabra_clave', 'proveedores_palabras_claves.desc_palabra_clave')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarPalabrasClave/' . $row->id_proveedor_palabra_clave);
                    $url2 = url('verPalabrasClave/' . $row->id_proveedor_palabra_clave);
                    if ($mode == "show") {
                        $actionBtn = ' <a onclick="editarPalabraClave(' . $row->id_proveedor_palabra_clave . ');" class="view btn btn-primary btn-sm" title="ver palabra clave">
                        <i class="fas fa-eye"></i></a>  ';

                        return $actionBtn;

                    } else {

                        $actionBtn = '<a onclick="editarPalabraClave(' . $row->id_proveedor_palabra_clave . ');" class="view btn btn-warning btn-sm" title="editar palabra clave">
                        <i class="fas fa-edit"></i></a> <a onclick="bajaPalabraClave(' . $row->id_proveedor_palabra_clave . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                        <i class="fas fa-exclamation-circle"></i></a>';

                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function crearPalabrasClave($id, Request $request)
    {
        try {
            $palabra = new Proveedor_palabra_clave();
            $palabra->id_proveedor = $id;
            $palabra->desc_palabra_clave = $request->palabra_clave;
            $palabra->save();

            return redirect()->back()->with('message', 'Palabra clave Creada Correctamente');
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function bajaPalabrasClave($id)
    {
        try {
            Proveedor_palabra_clave::findOrFail($id)->delete();
            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function getPalabrasClaveBD($id)
    {
        try {
            $data = Proveedor_palabra_clave::where('id_proveedor_palabra_clave', $id)->get();

            return $data;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function getProductos(Request $request, $id, $mode = null)
    {
        try {
            $data = Producto::where('id_proveedor', $id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarProductos/' . $row->id_producto);
                    $url2 = url('verProductos/' . $row->id_producto);

                    if ($mode == "show") {
                        $actionBtn = '<a onclick="verProducto(' . $row->id_producto . ');" class="view btn btn-primary btn-sm" title="ver producto">
                    <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a onclick="verProducto(' . $row->id_producto . ');" class="view btn btn-warning btn-sm" title="editar producto">
                    <i class="fas fa-edit"></i></a> <a onclick="bajaProducto(' . $row->id_producto . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarProductos($id)
    {
        try {
            $producto = Producto::where('id_producto', $id)->get();
            $producto = $producto[0];
            $productos = Producto::All();
            $mode = "edit";

            return view('ediciones.producto', compact('mode', 'producto', 'productos'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verProductos($id)
    {
        try {
            $producto = Producto::where('id_producto', $id)->get();
            $producto = $producto[0];
            $productos = Producto::All();

            return $producto;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaProductos($id)
    {
        try {
            Producto::findOrFail($id)->delete();
            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearProductos($id, Request $request)
    {
        try {
            $producto = new Producto($request->all());
            $producto->id_proveedor = $id;
            $producto->save();

            return redirect()->back()->with('message', 'Producto Creado Correctamente');
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoProductos($id)
    {
        try {
            $productos = Producto::All();

            $mode = "create";

            return view('ediciones.producto', compact('mode', 'id', 'productos'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function guardarProductos($id, Request $request)
    {
        try {
            $producto = Producto::find($id);

            $producto->producto_elaborado = $request->producto_elaborado1;
            $producto->rnpa = $request->rnpa1;
            $producto->Producida_unidad = $request->Producida_unidad1;
            $producto->capacidad_produccion_total = $request->capacidad_produccion_total1;

            $producto->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function guardarPalabrasClave($id, Request $request)
    {
        try {
            $palabra = Proveedor_palabra_clave::find($id);

            $palabra->desc_palabra_clave = $request->palabras_claves;

            $palabra->save();

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    public function getPatentes(Request $request, $id, $mode = null)
    {
        try {
            $data = Proveedor_patente::where('id_proveedor', $id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarPatentes/' . $row->id_proveedor_patente);
                    $url2 = url('verPatentes/' . $row->id_proveedor_patente);

                    if ($mode == "show") {
                        $actionBtn = ' <a onclick="editarPatente(' . $row->id_proveedor_patente . ');" value="' . $row->id_proveedor_patente . '" class="view btn btn-primary btn-sm" title="ver">
                    <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a onclick="editarPatente(' . $row->id_proveedor_patente . ');" value="' . $row->id_proveedor_patente . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="bajaPatente(' . $row->id_proveedor_patente . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;

                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getPatentesBD($id)
    {
        try {
            $data = Proveedor_patente::where('id_proveedor_patente', $id)->get();

            return $data;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarPatentes($id)
    {
        try {
            $patente = Proveedor_patente::where('id_proveedor_patente', $id)->get();
            $patente = $patente[0];
            $mode = "edit";
            return view('ediciones.patentes', compact('mode', 'patente'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verPatentes($id)
    {
        try {
            $patente = Proveedor_patente::where('id_proveedor_patente', $id)->get();
            $patente = $patente[0];
            $mode = "show";
            return view('ediciones.patentes', compact('mode', 'patente'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaPatentes($id)
    {
        try {
            Proveedor_patente::findOrFail($id)->delete();
            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearPatentes($id, Request $request)
    {
        try {
            $patente = new Proveedor_patente($request->all());
            $patente->id_proveedor = $id;
            $patente->save();

            return redirect()->back()->with('message', 'Vehículo creado correctamente');
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoPatentes($id)
    {
        try {
            $mode = "create";

            return view('ediciones.patentes', compact('mode', 'id'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function guardarPatentes($id, Request $request)
    {
        try {
            $patente = Proveedor_patente::find($id);

            $patente = $patente->fill($request->all());

            $patente->dominio = $request->dominios;
            $patente->marca = $request->marcas;
            $patente->modelo = $request->modelos;
            $patente->inscripto_en = $request->inscriptos_en;

            $patente->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSeguros(Request $request, $id, $mode = null)
    {
        try {
            $data = Proveedor_seguro::where('id_proveedor', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarSeguros/' . $row->id_proveedor_seguro);
                    $url2 = url('verSeguros/' . $row->id_proveedor_seguro);

                    if ($mode == "show") {
                        $actionBtn = '<a onclick="editarSeguro(' . $row->id_proveedor_seguro . ');" value="' . $row->id_proveedor_seguro . '" class="view btn btn-primary btn-sm title="ver">
                    <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a onclick="editarSeguro(' . $row->id_proveedor_seguro . ');" value="' . $row->id_proveedor_seguro . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="bajaSeguro(' . $row->id_proveedor_seguro . ');" class="delete btn btn-danger btn-sm" title="Dar de baja">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSegurosBD($id)
    {
        try {
            $data = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
            return $data;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarSeguros($id)
    {
        try {
            $seguro = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
            $seguro = $seguro[0];
            $mode = "edit";

            return view('ediciones.seguros', compact('mode', 'seguro'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verSeguros($id)
    {
        try {
            $seguro = Proveedor_seguro::where('id_proveedor_seguro', $id)->get();
            $seguro = $seguro[0];
            $mode = "show";

            return view('ediciones.seguros', compact('mode', 'seguro'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaSeguros($id)
    {
        try {
            Proveedor_seguro::findOrFail($id)->delete();
            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearSeguros($id, Request $request)
    {
        try {
            $seguro = new Proveedor_seguro($request->all());
            $seguro->id_proveedor = $id;
            $seguro->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoSeguros($id)
    {
        try {
            $mode = "create";

            return view('ediciones.seguros', compact('mode', 'id'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function guardarSeguros($id, Request $request)
    {
        try {
            $seguro = Proveedor_seguro::find($id);

            $seguro = $seguro->fill($request->all());

            $seguro->poliza = $request->polizas;
            $seguro->agencia = $request->agencias;
            $seguro->asegurado = $request->asegurados;
            $seguro->vigencia_hasta = $request->vigencias_hasta;

            $seguro->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSedes(Request $request, $id, $mode = null)
    {
        try {
            $data = Proveedor_sede::join("localidades", "localidades.id_localidad", "=", "proveedores_sedes.id_localidad")->where("proveedores_sedes.id_proveedor", "=", $id)->select("proveedores_sedes.id_proveedor_sede", "proveedores_sedes.domicilio", "localidades.nombre_localidad")->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    $url = url('editarSedes/' . $row->id_proveedor_sede);
                    $url2 = url('verSedes/' . $row->id_proveedor_sede);

                    if ($mode == "show") {
                        $actionBtn = '<a onclick="editarSede(' . $row->id_proveedor_sede . ');" value="' . $row->id_proveedor_sede . '" class="view btn btn-primary btn-sm" title="ver">
                    <i class="fas fa-eye"></i></a> ';
                        return $actionBtn;
                    } else {
                        $actionBtn = '<a onclick="editarSede(' . $row->id_proveedor_sede . ');" value="' . $row->id_proveedor_sede . '" class="edit btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="bajaSede(' . $row->id_proveedor_sede . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getSedesBD($id)
    {
        try {
            $data = Proveedor_sede::join("localidades", "localidades.id_localidad", "=", "proveedores_sedes.id_localidad")->join("provincias", "provincias.id_provincia", "=", "localidades.id_provincia")->where("proveedores_sedes.id_proveedor_sede", "=", $id)->select("proveedores_sedes.id_proveedor_sede", "proveedores_sedes.domicilio", "localidades.id_localidad", "provincias.nombre_provincia")->get();

            return $data;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarSedes($id)
    {
        try {
            $sede = Proveedor_sede::where('id_proveedor_sede', $id)->get();
            $sede = $sede[0];
            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $provinciaid = Localidad::where('id_localidad', $sede->Localidad)->get();
            if (empty($provinciaid[0]->id_provincia)) {
                $provinciaid = "";
            } else {
                $provinciaid = $provinciaid[0]->id_provincia;
            }
            $mode = "edit";
            return view('ediciones.sedes', compact('sede', 'mode', 'provincias', 'localidades', 'paises', 'provinciaid'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verSedes($id)
    {
        try {
            $sede = Proveedor_sede::where('id_proveedor_sede', $id)->get();
            $sede = $sede[0];
            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $provinciaid = Localidad::where('id_localidad', $sede->Localidad)->get();
            $provinciaid = $provinciaid[0]->id_provincia;
            $mode = "show";
            return view('ediciones.sedes', compact('sede', 'mode', 'provincias', 'localidades', 'paises', 'provinciaid'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function bajaSedes($id)
    {
        try {
            Proveedor_sede::findOrFail($id)->delete();
            return "success";
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearSedes($id, Request $request)
    {
        try {
            $sede = new Proveedor_sede($request->all());
            $sede->id_proveedor = $id;
            $sede->save();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function nuevoSedes($id)
    {
        try {
            $mode = "create";
            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();

            return view('ediciones.sedes', compact('id', 'mode', 'provincias', 'localidades', 'paises'));
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function guardarSedes($id, Request $request)
    {
        try {
            $sede = Proveedor_sede::find($id);

            $sede = $sede->fill($request->all());

            $sede->id_localidad = $request->Localidades;
            $sede->domicilio = $request->Domicilios;

            $sede->save();
            //return redirect()->back()->with('message', 'Los datos de la Sede fueron modificados correctamente');
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
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

    public function obtenerProveedorRupaeId2($id)
    {
        try {
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
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function obtenerProveedorRupaeId($id, $tab = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id);

            /*Cambio para utilizar relacion representante
            $persona = $proveedor->personas()->get();

            if ($persona->isEmpty()) {
                $persona = "";

            } else {
                $persona = $persona[0];
            }

            //return $persona;*/

            $persona=$proveedor->representante->first();

            $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
                ->first();

            $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();

            if ($provinciaidFiscal->isEmpty()) {
                $provinciaidFiscal = "";
            } else {
                $provinciaidFiscal = $provinciaidFiscal[0]->id_provincia;
            }

            $proveedor_email_fiscal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'fiscal')
                ->get();

            $proveedor_telefono_fiscal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'fiscal')
                ->get();

            $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
                ->first();

            $provinciaidLegal = Localidad::where('id_localidad', $proveedor_domicilio_legal->id_localidad)->get();

            if ($provinciaidLegal->isEmpty()) {
                $provinciaidLegal = "";
            } else {
                $provinciaidLegal = $provinciaidLegal[0]->id_provincia;
            }

            $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
                ->get();

            $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
                ->get();

            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
                ->first();

            $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

            if ($provinciaidReal->isEmpty()) {
                $provinciaidReal = "";
            } else {
                $provinciaidReal = $provinciaidReal[0]->id_provincia;
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

            return view('editarRegistro', compact('tab', 'persona', 'mode',
                'provinciaidReal', 'provinciaidLegal', 'provinciaidFiscal', 'paises', 'jerarquias', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones', 'proveedor',
                'id', 'proveedor_telefono_fiscal', 'proveedor_domicilio_fiscal', 'proveedor_email_fiscal', 'proveedor_telefono_legal', 'proveedor_domicilio_legal',
                'proveedor_email_legal', 'proveedor_telefono_real', 'proveedor_domicilio_real', 'proveedor_email_real', 'proveedores_tipos_proveedores',
                'sucursales', 'actividades', 'productos', 'patentes', 'seguros', 'sedes', 'pagos')
            );
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verProveedorRupaeId($id, $tab = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id);

            //return $proveedor;
            /*Cambio para utilizar relacion representante
            $persona = $proveedor->personas()->get();

            if ($persona->isEmpty()) {
                $persona = "";

            } else {
                $persona = $persona[0];
            }

            //return $persona;*/

            $persona=$proveedor->representante->first();
            $proveedor_domicilio_fiscal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'fiscal')
                ->first();
            if (empty($proveedor_domicilio_fiscal)) {
                $proveedor_domicilio_fiscal = "";
                $provinciaidFiscal = "";
            } else {
                $provinciaidFiscal = Localidad::where('id_localidad', $proveedor_domicilio_fiscal->id_localidad)->get();

                if ($provinciaidFiscal->isEmpty()) {
                    $provinciaidFiscal = "";
                } else {
                    $provinciaidFiscal = $provinciaidFiscal[0]->id_provincia;
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
                $provinciaidLegal = "";
            } else {
                $provinciaidLegal = $provinciaidLegal[0]->id_provincia;
            }

            $proveedor_email_legal = Proveedor_email::where('id_proveedor', $id)->where('tipo_email', 'legal')
                ->get();

            $proveedor_telefono_legal = Proveedor_telefono::where('id_proveedor', $id)->where('tipo_telefono', 'legal')
                ->get();

            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
                ->first();

            $provinciaidReal = Localidad::where('id_localidad', $proveedor_domicilio_real->id_localidad)->get();

            if ($provinciaidReal->isEmpty()) {
                $provinciaidReal = "";
            } else {
                $provinciaidReal = $provinciaidReal[0]->id_provincia;
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

            return view('verRegistro', compact('tab', 'persona', 'mode',
                'provinciaidReal', 'provinciaidLegal', 'provinciaidFiscal', 'paises', 'jerarquias', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones', 'proveedor',
                'id', 'proveedor_telefono_fiscal', 'proveedor_domicilio_fiscal', 'proveedor_email_fiscal', 'proveedor_telefono_legal', 'proveedor_domicilio_legal',
                'proveedor_email_legal', 'proveedor_telefono_real', 'proveedor_domicilio_real', 'proveedor_email_real', 'proveedores_tipos_proveedores',
                'sucursales', 'actividades', 'productos', 'patentes', 'seguros', 'sedes', 'pagos')
            );
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function editarProveedor($id, Request $request)
    {
        try {
            $cuit = Proveedor::where('cuit', str_replace("-","",$request->cuit))->where('id_proveedor','<>',$id)->exists();
            if(!$cuit){

                //Inicio de la transaccion
                DB::beginTransaction();

            $proveedor = Proveedor::find($id);

            //Cambio para utilizar relacion representante
            $persona = $proveedor->personas()->get();

            if ($persona->isEmpty()) {

                if ($request->dni_legal || $request->nombre_persona || $request->apellido_persona) {
                    $persona = Persona::create([
                        'dni_persona' => htmlspecialchars(str_replace(".","",$request->dni_legal)),
                        //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                        'nombre_persona' => htmlspecialchars($request->nombre_persona),
                        'apellido_persona' => htmlspecialchars($request->apellido_persona),
                        //'genero_persona'=>$proveedores_rupae->genero_persona,
                    ]);
                    $persona->save();
                    $proveedor->personas()->attach($persona);

                    //$persona =  "";
                } else {
                    $persona = "";
                }
            } else {
                $persona = $proveedor->personas()->first();
                $persona->update([
                    'dni_persona' => htmlspecialchars(str_replace(".","",$request->dni_legal)),
                    //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                    'nombre_persona' => htmlspecialchars($request->nombre_persona),
                    'apellido_persona' => htmlspecialchars($request->apellido_persona),
                    //'genero_persona'=>$proveedores_rupae->genero_persona,
                ]);
                $persona->save();

            }

/*
            $persona = $proveedor->representante->first();

            if (!$persona) {

                if ($request->dni_legal || $request->nombre_persona || $request->apellido_persona) {
                    $persona = Persona::create([
                        'dni_persona' => htmlspecialchars($request->dni_legal),
                        //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                        'nombre_persona' => htmlspecialchars($request->nombre_persona),
                        'apellido_persona' => htmlspecialchars($request->apellido_persona),
                        //'genero_persona'=>$proveedores_rupae->genero_persona,
                    ]);
                    $persona->save();
                    $proveedor->personas()->attach($persona, ['rol_persona_proveedor' => 'Representante']);

                    //$persona =  "";
                } else {
                    $persona = "";
                }
            } else {
                $persona->update([
                    'dni_persona' => htmlspecialchars($request->dni_legal),
                    //'cuil_persona'=>$proveedores_rupae->cuil_persona,
                    'nombre_persona' => htmlspecialchars($request->nombre_persona),
                    'apellido_persona' => htmlspecialchars($request->apellido_persona),
                    //'genero_persona'=>$proveedores_rupae->genero_persona,
                ]);
                $persona->save();
            }*/
            //----------------------------------Editar Domicilio Real---------------------------------------------

            $proveedor_domicilio_real = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'real')
                ->get();
            if ($proveedor_domicilio_real->isEmpty()) {

                if ($request->input('calle_real')) {
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
                            'cod_area_tel' => $request->telefono_real_cod[$i],
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

                } else {
                    $proveedor_domicilio_real = "";
                }
            } else {
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
                foreach ($telefonos_real as $k) {
                    //return $request->telefono_real[$i];

                    $telefono_real = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                    $telefono_real->update([
                        'nro_tel' => $request->telefono_real[$i],
                        'cod_area_tel' => $request->telefono_real_cod[$i],

                    ]);
                    $telefono_real->save();
                    $i++;

                }

                $arraySize = count($request->telefono_real);
                if ($i < 3) {
                    for ($i; $i < $arraySize; $i++) {
                        //---------Carga de Telefonos_Real----------

                        $telefono_real = Proveedor_telefono::create([
                            'nro_tel' => $request->telefono_real[$i],
                            'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                            'cod_area_tel' => $request->telefono_real_cod[$i],
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
                foreach ($emails_real as $j) {
                    //return $request->email_real[$i];

                    $email_real = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                    $email_real->update([
                        'email' => $request->email_real[$i],
                    ]);
                    $email_real->save();
                    $i++;

                }

                $arraySize = count($request->email_real);
                if ($i < 3) {

                    for ($i; $i < $arraySize; $i++) {
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

                if ($request->input('calle_legal')) {
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
                            'cod_area_tel' => $request->telefono_legal_cod[$i],
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

                } else {
                    $proveedor_domicilio_legal = "";
                }
            } else {
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
                foreach ($telefonos_legal as $k) {
                    //return $request->telefono_legal[$i];

                    $telefono_legal = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                    $telefono_legal->update([
                        'nro_tel' => $request->telefono_legal[$i],
                        'cod_area_tel' => $request->telefono_legal_cod[$i],
                    ]);
                    $telefono_legal->save();
                    $i++;

                }

                $arraySize = count($request->telefono_legal);
                if ($i < 3) {
                    for ($i; $i < $arraySize; $i++) {
                        //---------Carga de Telefonos_Legal----------

                        $telefono_legal = Proveedor_telefono::create([
                            'nro_tel' => $request->telefono_legal[$i],
                            'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                            'cod_area_tel' => $request->telefono_legal_cod[$i],

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
                foreach ($emails_legal as $j) {
                    //return $request->email_legal[$i];

                    $email_legal = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                    $email_legal->update([
                        'email' => $request->email_legal[$i],
                    ]);
                    $email_legal->save();
                    $i++;

                }

                $arraySize = count($request->email_legal);
                if ($i < 3) {

                    for ($i; $i < $arraySize; $i++) {
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

                if ($request->input('calle_fiscal')) {
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
                            'cod_area_tel' => $request->telefono_fiscal_cod[$i],

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

                } else {
                    $proveedor_domicilio_fiscal = "";
                }
            } else {
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
                foreach ($telefonos_fiscal as $k) {
                    //return $request->telefono_fiscal[$i];

                    $telefono_fiscal = Proveedor_telefono::where('id_proveedor_telefono', $k->id_proveedor_telefono)->first();

                    $telefono_fiscal->update([
                        'nro_tel' => $request->telefono_fiscal[$i],
                        'cod_area_tel' => $request->telefono_fiscal_cod[$i],

                    ]);
                    $telefono_fiscal->save();
                    $i++;

                }

                $arraySize = count($request->telefono_fiscal);
                if ($i < 3) {
                    for ($i; $i < $arraySize; $i++) {
                        //---------Carga de Telefonos_Fiscal----------

                        $telefono_fiscal = Proveedor_telefono::create([
                            'nro_tel' => $request->telefono_fiscal[$i],
                            'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                            'cod_area_tel' => $request->telefono_fiscal_cod[$i],
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
                foreach ($emails_fiscal as $j) {
                    //return $request->email_fiscal[$i];

                    $email_fiscal = Proveedor_email::where('id_proveedor_email', $j->id_proveedor_email)->first();

                    $email_fiscal->update([
                        'email' => $request->email_fiscal[$i],
                    ]);
                    $email_fiscal->save();
                    $i++;

                }

                $arraySize = count($request->email_fiscal);
                if ($i < 3) {

                    for ($i; $i < $arraySize; $i++) {
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
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '4')->get();
                if ($Proveedores_tipos_proveedores->isEmpty()) {
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '4',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            } else {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '4')->get();
                if (!$Proveedores_tipos_proveedores->isEmpty()) {
                    Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '4')->delete();
                }

            }

            if (isset($request->prov_estado)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '1')->get();
                if ($Proveedores_tipos_proveedores->isEmpty()) {
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '1',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            } else {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '1')->get();
                if (!$Proveedores_tipos_proveedores->isEmpty()) {
                    Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '1')->delete();
                }

            }

            if (isset($request->prov_minero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '2')->get();
                if ($Proveedores_tipos_proveedores->isEmpty()) {
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '2',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            } else {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '2')->get();
                if (!$Proveedores_tipos_proveedores->isEmpty()) {
                    Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '2')->delete();
                }

            }

            if (isset($request->prov_petrolero)) {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '3')->get();
                if ($Proveedores_tipos_proveedores->isEmpty()) {
                    $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::create([
                        'id_proveedor' => htmlspecialchars($proveedor->id_proveedor),
                        'id_tipo_proveedor' => '3',
                    ]);
                    $Proveedores_tipos_proveedores->save();
                }
            } else {
                $Proveedores_tipos_proveedores = Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '3')->get();
                if (!$Proveedores_tipos_proveedores->isEmpty()) {
                    Proveedores_tipos_proveedores::where('id_proveedor', $proveedor->id_proveedor)->where('id_tipo_proveedor', '3')->delete();
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
            $proveedores_rupae->masa_salarial_bruta= str_replace(",",".",str_replace(".","",$request->masa_salarial_bruta));
            $proveedores_rupae->cuit= str_replace("-","",$request->cuit);

            $proveedores_rupae->facturacion_anual_alcanzada= str_replace(",",".",str_replace(".","",$request->facturacion_anual_alcanzada));



            $proveedores_rupae->save();

            //Fin de la transaccion
            DB::commit();


            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se han modificado los datos del registro con el cuit: ' . $request->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);


            return redirect()->back()->withSuccess('Los datos del registro se han modificado satisfactoriamente !');
            }
            else{
                return Redirect::back()
                ->withErrors(['El CUIT ya se encuentra registrado']);
            }
        } catch (\Exception$e) {

            //Si algo fallo, volvemos la transaccion atras
            DB::rollBack();

            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function dar_baja(Request $request)
    {
        try {
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupae = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupae);
            $proveedores_rupae->dado_de_baja = 1;
            $proveedores_rupae->save();

            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de baja el registro con el cuit: ' . $proveedores_rupae->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);

            return redirect()->back();

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

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
        try {
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupae = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupae);
            $proveedores_rupae->dado_de_baja = 1;
            $proveedores_rupae->save();

            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de baja el registro con el cuit: ' . $proveedores_rupae->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);

            return redirect()->back();

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function dar_alta_id(Request $request)
    {
        try {
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupae = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupae);
            $proveedores_rupae->dado_de_baja = 0;
            $proveedores_rupae->save();

            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de alta el registro con el cuit: ' . $proveedores_rupae->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);

            return redirect()->back();

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

//ESTA FUNCION SE VA A UTILIZAR PARA ELIMINAR UN REGISTRO DE LA BD (FALTA TERMINAR DE IMPLEMENTAR)

/*
    public function eliminar_id(Request $request)
    {
        try {
            $id_proveedor = htmlspecialchars($request->id);
            $proveedor = Proveedor::findOrFail($id_proveedor);
            $personas = $proveedor->personas();
            $proveedor->personas()->detach();
            $personas->delete();
            $proveedor->delete();
            //return "success";

            //$proveedores_rupae = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupae);
            //$proveedores_rupae->dado_de_baja = 1;
            //$proveedores_rupae->save();
            return redirect()->back();
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }
*/

    public function getLocalidades($provincia, Request $request)
    {
        try {
            //obtenemos el id de la provincia
            $provinciaid = DB::table('provincias')->where('nombre_provincia', $provincia)->first();

            //Obtenemos las localidades de la provincia seleccionada
            $localidades = Localidad::where('id_provincia', $provinciaid->id_provincia)->orderby('nombre_localidad', 'asc')->get();

            //Calculamos el tamaño de las localidades
            $max = sizeof($localidades);

            //var_dump(json_decode(json_encode($localidades[0]["nombre_localidad"])));

            $select = '<option value="" disabled hidden>Seleccione una localidad</option>';
            for ($i = 0; $i < $max; $i++) {
                $select = $select . '<option value=' . $localidades[$i]["id_localidad"] . '>' . $localidades[$i]["nombre_localidad"] . '</option>';
            }

            return $select;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getLocalidadSelect($id, Request $request)
    {
        try {
            //code...

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
        } catch (\Throwable$th) {
            $message = "Error.";
            return $message;}
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
        try {

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


            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se han modificado los valores de las fórmulas (Ponderación - Jerarquía e Indice)',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);


            return redirect()->back()->withSuccess('Los valores de las fórmulas se han actualizado satisfactoriamente.');

        } catch (\Illuminate\Database\QueryException$ex) {
            //dd($ex->getMessage());
            $message = "Los valores introducidos en los campos de Ponderación deben ser menores a 10.";
            return redirect()->back()->withErrors($message);
        }

    }

    /*  Funcion para limpiar registros de la base de datos,
    cuando se selecciona limpiar los datos de formulario*/
    public function limpiar(Request $request)
    {
        try {
            echo "im in AjaxController index" . $request->input('id_proveedor');
            /*$id_proveedor=$request->input('id_proveedor');
        $proveedor=Proveedor::findOrFail($id_proveedor);
        $proveedor->domicilios()->delete();*/
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    //Devuelve el contenido de la tabla eventos_log
    public function obtenerListadoAcciones()
    {
        $acciones = DB::connection("mysql")->select("SELECT * FROM eventos_log");

        return datatables()->of($acciones)->make(true);
    }

}
