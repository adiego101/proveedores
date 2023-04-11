<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProveedoresController;
use App\Models\Actividades_proveedores;
use App\Models\Actividad_economica;

use App\Models\Disposiciones_act_prov;
use App\Models\Localidad;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\Proveedor;
use App\Models\Proveedor_estado;

use App\Models\Proveedor_domicilio;
use App\Models\Proveedor_email;
use App\Models\Proveedor_telefono;
use App\Models\Proveedor_firma;
use App\Models\Proveedor_banco;
use App\Models\Provincia;
use App\Models\Tipo_actividad;
use App\Models\Proveedor_firma_nac_extr;
use App\Models\Banco;
use App\Models\Disposicion;
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

                    Log::info($proveedor);

                    return redirect()->route('modificar.Registro', ['id' => $proveedor->id_proveedor])->with('message', 'El cuil ingresado: '. $request->cuit . ' ya existe. Puede modificar el registro a continuacion.');

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
            //$dado_de_baja = Proveedor::where('cuit', str_replace("-","",$request->cuit))->where('dado_de_baja', '0')->get();
            //return $dado_de_baja->isEmpty();
            //return empty($dado_de_baja);
            //return $cuit;
            if (!$cuit/*|| $dado_de_baja->isEmpty()*/) {

            //return response()->json($request->cuit);


                //-------------------Carga Proveedor-------------------

                //Inicio de la transaccion
            DB::beginTransaction();


                    //-------------------Carga Proveedor-------------------
                    $proveedores_rupep = new Proveedor($request->all());
                    $proveedores_rupep->cuit= str_replace("-","",$request->cuit);
                    $proveedores_rupep->save();


                   /* //Crear Disposicion
                    Disposicion::create([   'id_proveedor'=>$proveedores_rupep->id_proveedor,
                    'nro_disposicion'=>$request->nro_disposicion,
                    'fecha_ini_vigencia'=>$request->fecha_inicio_disposicion,
                    'fecha_fin_vigencia'=>$request->fecha_fin_disposicion,
                    'disposicion_tipo'=>$request->tipo_disposicion,
                    //'GDE_Exp'=>$request->nro_expte_gde,
                    'observaciones'=>$request->observaciones_disposicion]);
*/



                    //----------------------------------Carga Domicilio Real---------------------------------------------
                    $this->crear_domicilio($proveedores_rupep->id_proveedor, 'real', $request);

                    //---------Carga Telefono/s_Real----------

                    $this->crear_telefonos($proveedores_rupep->id_proveedor, 'real', $request);

                    //---------Carga de Email/s_Real----------

                    $this->crear_emails($proveedores_rupep->id_proveedor, 'real', $request);



                    //---------Carga de Representante Legal----------

                    $dni_persona=htmlspecialchars(str_replace(".","",$request->dni_legal));
                    $nombre_persona=htmlspecialchars($request->nombre_persona);
                    $apellido_persona=htmlspecialchars($request->apellido_persona);
                    if($dni_persona!='' && $nombre_persona!='' && $apellido_persona!='')
                    {
                        $Representante_legal = Persona::where('dni_persona',$dni_persona)
                                                    ->first();
                        if(!isset($Representante_legal))
                            $Representante_legal = Persona::create([
                                'dni_persona' => $dni_persona,
                                //'cuil_persona'=>$proveedores_rupep->cuil_persona,
                                'nombre_persona' => $nombre_persona,
                                'apellido_persona' => $apellido_persona,
                                //'apellido_persona'=>$proveedores_rupep->apellido_persona,
                                //'genero_persona'=>$proveedores_rupep->genero_persona,
                            ]);
                        else
                        {
                            if($Representante_legal->nombre_persona!=$nombre_persona)
                                $Representante_legal->update(['nombre_persona'=>$nombre_persona]);
                            if($Representante_legal->apellido_persona!=$apellido_persona)
                                $Representante_legal->update(['apellido_persona'=>$apellido_persona]);
                        }

                        $proveedores_rupep->personas()->attach($Representante_legal, ['rol_persona_proveedor' => 'Representante']);
                    }

                    //----------------------------------Carga Domicilio Fiscal---------------------------------------------

                    $this->crear_domicilio($proveedores_rupep->id_proveedor, 'fiscal', $request);

                    //---------Carga Telefono_Fiscal----------

                    $this->crear_telefonos($proveedores_rupep->id_proveedor, 'fiscal', $request);

                    //---------Carga de Email/s_fiscal----------

                    $this->crear_emails($proveedores_rupep->id_proveedor, 'fiscal', $request);

/*
                    //---------Contador de Actividades----------
                    if (isset($request->tipos_actividades)) {

                        $arraySize = count($request->tipos_actividades);
                        var_dump($arraySize);

                        //---------Carga de Actividades----------

                        for ($i = 0; $i < $arraySize; $i++) {
                            $actividades_proveedores = Actividades_proveedores::create([
                                'id_proveedor' => htmlspecialchars($proveedores_rupep->id_proveedor),
                                'id_tipo_actividad' => $this->idtipos_actividades($request->tipos_actividades[$i]),
                                'id_actividad_economica' => $this->idActividad_economica($request->actividades[$i]),
                            ]);

                            $actividades_proveedores->save();
                        }
                    }*/


                    //---------Contador de Pagos----------
                    if (isset($request->importes_pagos)) {

                        $arraySize = count($request->importes_pagos);
                        var_dump($arraySize);

                        //---------Carga de Pagos----------
                        for ($i = 0; $i < $arraySize; $i++) {
                            $Pago = Pago::create([
                                'id_proveedor' => htmlspecialchars($proveedores_rupep->id_proveedor),
                                'fecha' => $request->fechas_pagos[$i],
                                'importe' => $request->importes_pagos[$i],
                                'observaciones' => $request->observaciones_pagos[$i],

                            ]);
                            $Pago->save();
                        }
                    }

                    //---------Carga de Firmas Nacionales y Extranjeras ----------


                    if (isset($request->denominaciones)) {

                        $arraySize = count($request->denominaciones);
                        var_dump($arraySize);

                        //---------Carga de Firmas Nacionales y Extranjeras ----------
                        for ($i = 0; $i < $arraySize; $i++) {
                            $Proveedor_firma_nac_extr = Proveedor_firma_nac_extr::create([
                                'id_proveedor' => htmlspecialchars($proveedores_rupep->id_proveedor),
                                'denominacion_firma' => $request->denominaciones[$i],
                            ]);
                            $Proveedor_firma_nac_extr->save();
                        }
                    }


                    //---------Contador de Referencias Bancarias----------
                    if (isset($request->nombres_bancos)) {

                        $arraySize = count($request->nombres_bancos);
                        var_dump($arraySize);

                        //---------Carga de Referencias Bancarias----------
                        for ($i = 0; $i < $arraySize; $i++) {
                            $Proveedor_banco = Proveedor_banco::create([
                                'id_proveedor' => htmlspecialchars($proveedores_rupep->id_proveedor),
                                'id_banco' => $request->nombres_bancos[$i],
                                'id_localidad' => $request->localidad_sucursales[$i],
                                'tipo_cuenta' => $request->tipos_cuentas[$i],
                                'nro_cuenta' => $request->nros_cuentas[$i],

                            ]);
                            $Proveedor_banco->save();
                        }
                    }


                //Registro de LOG
                $responsable_id = User::findOrFail(auth()->id())->id;
                $responsable_nombre = User::findOrFail(auth()->id())->name;
                $responsable_email = User::findOrFail(auth()->id())->email;

                /*DB::connection('mysql')
                ->table('eventos_log')->insert(['EL_Evento' => 'Se ha creado un nuevo registro con el cuit: ' . $request->cuit . '.',
                'EL_Evento_Fecha' => Carbon::now(),
                'EL_Id_Responsable' => $responsable_id,
                'EL_Nombre_Responsable' => $responsable_nombre,
                'EL_Email_Responsable' => $responsable_email]);*/

                //Fin de la transaccion
                DB::commit();

                return redirect()->route('nuevoRegistro2', ['id' => $proveedores_rupep->id_proveedor])->with('message', 'Proveedor creado correctamente');



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

    public function crear_domicilio($id_proveedor, $tipo_domicilio, Request $request)
    {
        $calle=htmlspecialchars($request->input("calle_$tipo_domicilio"));
        $numero=htmlspecialchars($request->input("numero_$tipo_domicilio"));
        $dpto=htmlspecialchars($request->input("dpto_$tipo_domicilio"));
        $puerta=htmlspecialchars($request->input("puerta_$tipo_domicilio"));
        $lote=htmlspecialchars($request->input("lote_$tipo_domicilio"));
        $manzana=htmlspecialchars($request->input("manzana_$tipo_domicilio"));
        $entre_calles=htmlspecialchars($request->input("entreCalles_$tipo_domicilio"));
        $oficina=htmlspecialchars($request->input("oficina_$tipo_domicilio"));
        $monoblock=htmlspecialchars($request->input("monoblock_$tipo_domicilio"));
        $barrio=htmlspecialchars($request->input("barrio_$tipo_domicilio"));
        $localidad=$request->input("localidad_$tipo_domicilio");
        $codigo_postal=htmlspecialchars($request->input("cp_$tipo_domicilio"));

        if( $calle!=''||$numero!=''||$dpto!=''||$puerta!=''||
            $lote!=''||$manzana!=''||$entre_calles!=''||
            $oficina!=''||$monoblock!=''||$barrio!=''||
            $localidad!=''||$codigo_postal!='')
        {
            if($numero!='')
                $domicilio = Proveedor_domicilio::create([
                    'tipo_domicilio' => $tipo_domicilio,
                    //'nro_orden_domicilio',
                    'calle' => $calle,
                    'id_proveedor' => $id_proveedor,
                    'numero' => $numero,
                    'dpto' => $dpto,
                    'puerta' => $puerta,
                    'lote' => $lote,
                    'manzana' => $manzana,
                    'entre_calles' => $entre_calles,
                    'oficina' => $oficina,
                    'monoblock' => $monoblock,
                    'barrio' => $barrio,
                    'id_localidad' => $localidad,
                    'codigo_postal' => $codigo_postal,
                ]);
            else
                $domicilio = Proveedor_domicilio::create([
                    'tipo_domicilio' => $tipo_domicilio,
                    //'nro_orden_domicilio',
                    'calle' => $calle,
                    'id_proveedor' => $id_proveedor,
                    'dpto' => $dpto,
                    'puerta' => $puerta,
                    'lote' => $lote,
                    'manzana' => $manzana,
                    'entre_calles' => $entre_calles,
                    'oficina' => $oficina,
                    'monoblock' => $monoblock,
                    'barrio' => $barrio,
                    'id_localidad' => $localidad,
                    'codigo_postal' => $codigo_postal,
                ]);
            $domicilio->save();
        }
        return;
    }

    public function actualizar_domicilio($domicilio, $tipo_domicilio, Request $request)
    {
        $calle=htmlspecialchars($request->input("calle_$tipo_domicilio"));
        $numero=htmlspecialchars($request->input("numero_$tipo_domicilio"));
        $dpto=htmlspecialchars($request->input("dpto_$tipo_domicilio"));
        $puerta=htmlspecialchars($request->input("puerta_$tipo_domicilio"));
        $lote=htmlspecialchars($request->input("lote_$tipo_domicilio"));
        $manzana=htmlspecialchars($request->input("manzana_$tipo_domicilio"));
        $entre_calles=htmlspecialchars($request->input("entreCalles_$tipo_domicilio"));
        $oficina=htmlspecialchars($request->input("oficina_$tipo_domicilio"));
        $monoblock=htmlspecialchars($request->input("monoblock_$tipo_domicilio"));
        $barrio=htmlspecialchars($request->input("barrio_$tipo_domicilio"));
        $localidad=$request->input("localidad_$tipo_domicilio");
        $codigo_postal=htmlspecialchars($request->input("cp_$tipo_domicilio"));
        Log::info("codigo postal =".$codigo_postal);

        if( $calle!=''||$numero!=''||$dpto!=''||$puerta!=''||
            $lote!=''||$manzana!=''||$entre_calles!=''||
            $oficina!=''||$monoblock!=''||$barrio!=''||
            $localidad!=''||$codigo_postal!='')
        {
            $domicilio = $domicilio->update([
                'tipo_domicilio' => $tipo_domicilio,
                //'nro_orden_domicilio',
                'calle' => $calle,
                'numero' => $numero,
                'dpto' => $dpto,
                'puerta' => $puerta,
                'lote' => $lote,
                'manzana' => $manzana,
                'entre_calles' => $entre_calles,
                'oficina' => $oficina,
                'monoblock' => $monoblock,
                'barrio' => $barrio,
                'id_localidad' => $localidad,
                'codigo_postal' => $codigo_postal
            ]);
        }
        return;
    }

    public function crear_telefonos($id_proveedor, $tipo_telefono, Request $request)
    {
        $cantidad_telefonos=0;
        switch($tipo_telefono){
            case('real'):
                $cantidad_telefonos=count($request->telefono_real);
                break;
            /*case('legal'):
                $cantidad_telefonos=count($request->telefono_legal);
                break;*/
            case('fiscal'):
                $cantidad_telefonos=count($request->telefono_fiscal);
                break;
        }

        for($i = 0; $i < $cantidad_telefonos; $i++)
        {
            $nro_tel=$request->input("telefono_$tipo_telefono.".$i);
            $cod_area_tel=$request->input("telefono_$tipo_telefono"."_cod.".$i);
            if($nro_tel!=''||$cod_area_tel!='')
                $this->crear_telefono($id_proveedor, $nro_tel, $cod_area_tel, $tipo_telefono);
        }
        return;
    }

    public function crear_telefono($id_proveedor, $nro_tel, $cod_area_tel, $tipo_telefono)
    {
        $telefono = Proveedor_telefono::create([
            'nro_tel' => $nro_tel,
            'id_proveedor' => $id_proveedor,
            'cod_area_tel' => $cod_area_tel,
            //'tipo_medio'=>,
            //'desc_telefono'=>,
            'tipo_telefono' => $tipo_telefono,
            //'nro_orden_telefono'=>,
        ]);
        $telefono->save();
        return;
    }

    public function actualizar_telefonos($id_proveedor, $tipo_telefono, Request $request)
    {
        $cantidad_telefonos=0;
        switch($tipo_telefono){
            case('real'):
                $cantidad_telefonos=0;
                $cantidad_telefonos=count($request->telefono_real);
                break;
        /*    case('legal'):
                $cantidad_telefonos=0;

                $cantidad_telefonos=count($request->telefono_legal);
                break;*/
            case('fiscal'):
                $cantidad_telefonos=0;
                $cantidad_telefonos=count($request->telefono_fiscal);
                break;
        }

        $telefonos_proveedor=Proveedor_telefono::where('id_proveedor',$id_proveedor)
                                                ->where('tipo_telefono',$tipo_telefono)
                                                ->get();
        if(isset($telefonos_proveedor) && $telefonos_proveedor->isNotEmpty())
        {
            foreach($telefonos_proveedor as $telefono_proveedor)
            {
                $encontrado=false;

                for($i = 0; $i < $cantidad_telefonos; $i++)
                {
                    $nro_tel=$request->input("telefono_$tipo_telefono.".$i);
                    $cod_area_tel=$request->input("telefono_$tipo_telefono"."_cod.".$i);
                    if($nro_tel!=''||$cod_area_tel!='')
                        if($telefono_proveedor->nro_tel==$nro_tel && $telefono_proveedor->cod_area_tel==$cod_area_tel)
                        {
                            $encontrado=true;
                            $telefono_proveedor->updated_at=Carbon::now();
                            $telefono_proveedor->save();
                        }
                }
                if(!$encontrado)
                    $telefono_proveedor->delete();
            }
            for($i = 0; $i < $cantidad_telefonos; $i++)
            {
                $encontrado=false;
                $nro_tel=$request->input("telefono_$tipo_telefono.".$i);
                $cod_area_tel=$request->input("telefono_$tipo_telefono"."_cod.".$i);
                if($nro_tel!=''||$cod_area_tel!='')
                {
                    foreach($telefonos_proveedor as $telefono_proveedor)
                        if($telefono_proveedor->nro_tel==$nro_tel && $telefono_proveedor->cod_area_tel==$cod_area_tel)
                            $encontrado=true;
                    if(!$encontrado)
                        $this->crear_telefono($id_proveedor,$nro_tel, $cod_area_tel, $tipo_telefono);
                }
            }
        }
        else
            $this->crear_telefonos($id_proveedor, $tipo_telefono, $request);
        return;
    }

    public function crear_emails($id_proveedor, $tipo_email, Request $request)
    {
        $cantidad_emails=0;
        switch($tipo_email){
            case('real'):
                $cantidad_emails=count($request->email_real);
                Log::info("cantidad emails real request=".$cantidad_emails);
                break;
            /*case('legal'):
                $cantidad_emails=count($request->email_legal);
                Log::info("cantidad emails legal request=".$cantidad_emails);
                break;*/
            case('fiscal'):
                $cantidad_emails=count($request->email_fiscal);
                Log::info("cantidad emails fiscal request=".$cantidad_emails);
                break;
        }

        for($i = 0; $i < $cantidad_emails; $i++)
        {
            $email=$request->input("email_$tipo_email.".$i);
            Log::info("email nº".$i."=".$email);
            if($email!='')
                $this->crear_email($id_proveedor, $email, $tipo_email);
        }
        return;
    }

    public function crear_email($id_proveedor, $email, $tipo_email)
    {
        $email = Proveedor_email::create([
            'email' => $email,
            'id_proveedor' => $id_proveedor,
            'tipo_email' => $tipo_email,
        ]);
        $email->save();
        Log::info("email guardado = ".$email);
        return;
    }

    public function actualizar_emails($id_proveedor, $tipo_email, Request $request)
    {
        $cantidad_emails=0;
        switch($tipo_email){
            case('real'):
                $cantidad_emails=count($request->email_real);
                Log::info('Cantidad de emails real='.$cantidad_emails);
                break;
           /* case('legal'):
                $cantidad_emails=count($request->email_legal);
                Log::info('Cantidad de emails legal='.$cantidad_emails);
                break;*/
            case('fiscal'):
                $cantidad_emails=count($request->email_fiscal);
                Log::info('Cantidad de emails fiscal='.$cantidad_emails);
                break;
        }

        $emails_proveedor=Proveedor_email::where('id_proveedor',$id_proveedor)
                                                ->where('tipo_email',$tipo_email)
                                                ->get();
        Log::info('Emails '.$emails_proveedor.'='.$cantidad_emails);
        if(isset($emails_proveedor) && $emails_proveedor->isNotEmpty())
        {
            Log::info('Existe emails proveedor y no esta vacio');
            foreach($emails_proveedor as $email_proveedor)
            {
                $encontrado=false;
                for($i = 0; $i < $cantidad_emails; $i++)
                {
                    $email=$request->input("email_$tipo_email.$i");
                    if($email!='')
                        if($email_proveedor->email==$email)
                        {
                            $encontrado=true;
                            $email_proveedor->updated_at=Carbon::now();
                            $email_proveedor->save();
                        }
                }
                if(!$encontrado)
                    $email_proveedor->delete();
            }
            for($i = 0; $i < $cantidad_emails; $i++)
            {
                $encontrado=false;
                $email=$request->input("email_$tipo_email.$i");
                if($email!='')
                {
                    foreach($emails_proveedor as $email_proveedor)
                        if($email_proveedor->email==$email)
                            $encontrado=true;
                    if(!$encontrado)
                        $this->crear_email($id_proveedor,$email, $tipo_email);
                }
            }

        }
        else
            $this->crear_emails($id_proveedor, $tipo_email, $request);
        return;
    }

    /*
    Funcion que devuelve un listado de proveedores almacenados en la BD (Datatable)
    junto a los botones para editar, ver y dar de baja un registro
     */
    public function getProveedores(Request $request)
    {
        try {
            $fecha=date('Y-m-d');
            if ($request->ajax()) {
            
                /*$data = Proveedor::join('disposiciones', 'proveedores.id_proveedor', '=', 'disposiciones.id_proveedor')
                ->select('razon_social', 'nombre_fantasia', 'cuit', 'disposicion_tipo','disposiciones.fecha_fin_vigencia', 'proveedores.id_proveedor')
                ->where(function($query){
                    $query->where('disposiciones.disposicion_tipo', '=', 'inscripcion')
                    ->orWhere('disposiciones.disposicion_tipo', '=', 'renovacion')
                    ->orWhere('disposiciones.disposicion_tipo', '=', 'baja');
                    });

                $data = $data->where('fecha_fin_vigencia', function($queryBuilder){
                    $queryBuilder->selectRaw('MAX(fecha_fin_vigencia) as fecha')
                    ->from('disposiciones')
                    ->groupBy('id_proveedor');
                })*/

                $data = Proveedor::join('disposiciones', 'proveedores.id_proveedor', '=', 'disposiciones.id_proveedor')
                ->select('razon_social', 'nombre_fantasia', 'cuit', 'disposicion_tipo','disposiciones.fecha_fin_vigencia', 'proveedores.id_proveedor')
               
                ->selectRaw('MAX(fecha_fin_vigencia) as fecha')
                ->where('disposicion_tipo', 'renovacion')
                ->orWhere('disposicion_tipo', 'inscripcion')
                ->orWhere('disposicion_tipo', 'baja')
                ->groupBy('proveedores.id_proveedor')
                ->get();
                Log::info($data);
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        if ($row->dado_de_baja == 0) {
                            $actionBtn = '<a href="modificarRegistro/' . "$row->id_proveedor" . '" class="edit btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="bajaRegistro(' . $row->id_proveedor . ');" class="delete btn btn-danger btn-sm" title="Dar de baja"><i class="fas fa-exclamation-circle"></i></a>';
                        } else {

                            //BOTON ELIMINAR REGISTRO COMENTADO

                            $actionBtn = '<button class="edit btn btn-warning btn-sm" title="Editar" disabled><i class="fas fa-edit"></i></button> <a href="verRegistro/' . "$row->id_proveedor" . '" class="view btn btn-primary btn-sm" title="Ver"><i class="fas fa-eye"></i></a> <a onclick="altaRegistro(' . $row->id_proveedor . ');" class="alta btn btn-success btn-sm" title="Dar de alta"><i class="fas fa-arrow-alt-circle-up"></i></a> <a onclick="eliminarRegistro(' . $row->id_proveedor . ');" class="eliminar btn btn-outline-danger btn-sm" title="Eliminar">X</a>';

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

    public function getEstadoProveedores(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Proveedor::join('disposiciones', 'proveedores.id_proveedor','=', 'disposiciones.id_proveedor')
                ->select('proveedores.razon_social', 'proveedores.nombre_fantasia', 'proveedores.cuit', 'disposiciones.fecha_fin_vigencia')
                ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->make(true);
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getDisposiciones(Request $request, $id_proveedor, $mode = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id_proveedor);
            $proveedor->load('disposiciones');
            $disposiciones = $proveedor->disposiciones;
            Log::info("disposiciones = ".$disposiciones);
            return Datatables::of($disposiciones)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    if ($mode == "show")
                    {
                        $actionBtn = '<a class="view btn btn-info btn-sm show_disposicion" title="editar disposicion" data-id-proveedor="'.$row->id_proveedor.'" data-id-disposicion="'.$row->id_disposicion.'">
                    <i class="fas fa-eye"></i></a>';
                        return $actionBtn;
                    }
                    else
                    {
                        $actionBtn = '<a class="view btn btn-warning btn-sm edit_disposicion" title="editar disposicion" data-id-proveedor="'.$row->id_proveedor.'" data-id-disposicion="'.$row->id_disposicion.'">
                    <i class="fas fa-edit"></i></a> <a type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBaja" title="Dar de baja" data-tipo-baja="disposicion" data-id-disposicion="'.$row->id_disposicion.'">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getDisposicionesJson(Request $request, $id_proveedor, $tipo = null)
    {
        try {
            if($tipo == null){
                $proveedor = Proveedor::findOrFail($id_proveedor);
                $proveedor->load('disposiciones');
                $disposiciones = $proveedor->disposiciones->where("disposicion_tipo",'!=' , "BAJA");
                return response()->json($disposiciones);
            }
            else{
                if($tipo == "baja"){
                    $proveedor = Proveedor::findOrFail($id_proveedor);
                    $proveedor->load('disposiciones');
                    $disposiciones = $proveedor->disposiciones->where("disposicion_tipo", "BAJA");
                    return response()->json($disposiciones);
                }
            }

        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getNroDisposiciones($id_proveedor, $nro_disposicion)
    {
        //Log::info("nro_disposicion=".$nro_disposicion);
        try {
            $disposiciones=Disposicion::where('id_proveedor',$id_proveedor)
                        ->select('nro_disposicion')
                        ->where('nro_disposicion', 'like', $nro_disposicion.'%')
                        ->get();
            Log::info("disposiciones por numero = ".$disposiciones);
            return $disposiciones->map(function($disposicion){
                return collect(['label'=>$disposicion->nro_disposicion,
                                'value'=>$disposicion->nro_disposicion]);
                });
            return $disposiciones;
        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearDisposicion($id_proveedor, Request $request)
    {
        Log::info("Entra en funcion crearDisposicion con nro_disposicion=".$request->nro_disposicion." fecha inicio=".$request->fecha_inicio." fecha fin=".$request->fecha_fin." tipo disposicion=".$request->tipo_disposicion ." observaciones=".$request->observaciones);
        try {
            $disposicion = Disposicion::create([   'id_proveedor'=>$id_proveedor,
                                    'nro_disposicion'=>$request->nro_disposicion,
                                    'fecha_ini_vigencia'=>$request->fecha_inicio,
                                    'fecha_fin_vigencia'=>$request->fecha_fin,
                                    'disposicion_tipo'=>$request->tipo_disposicion,
                                    //'GDE_Exp'=>$request->nro_expte_gde,
                                    'observaciones'=>$request->observaciones]);
            Proveedor_estado::create([

                'id_proveedor'=>$id_proveedor,
                'id_disposicion'=>$disposicion->id_disposicion,
                'pe_start_date'=>$disposicion->fecha_ini_vigencia,
                'pe_end_date'=> null,
                'estado_cod'=> "VD a definir",]);


        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function verDisposicion($id_proveedor, $id_disposicion)
    {
        Log::info("***");
        Log::info('si entra a ver disposicion con '.$id_proveedor. ' y '.$id_disposicion);
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('disposiciones');
            $disposicion=$proveedor->disposiciones->where('id_disposicion', $id_disposicion)->first();
            Log::info("disposicion".$disposicion);
            return $disposicion;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function actualizarDisposicion($id_proveedor, $id_disposicion, Request $request)
    {
        Log::info("**");
        Log::info('si entra a actualizar disposicion con '.$id_proveedor. ' y '.$id_disposicion);
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('disposiciones');
            $disposicion=$proveedor->disposiciones->where('id_disposicion', $id_disposicion)->first();
            $disposicion->update([  'nro_disposicion'=>$request->nro_disposicion,
                                    'fecha_ini_vigencia'=>$request->fecha_inicio,
                                    'fecha_fin_vigencia'=>$request->fecha_fin,
                                    'disposicion_tipo'=>$request->tipo_disposicion,
                                    //'GDE_Exp'=>$request->nro_expte_gde,
                                    'observaciones'=>$request->observaciones]);
            Log::info("disposicion".$disposicion);
            return $disposicion;
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

    //METODO PARA RECUPERAR LAS REFERENCIAS BANCARIAS DE LA BD Y CARGARLAS EN LA TABLA DEL EDITAR REGISTRO
    //Falta implementar.
    public function getReferenciasBancarias(Request $request, $id_proveedor, $mode = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id_proveedor);
            $proveedor->load('bancos');
            $bancos = $proveedor->bancos;
            Log::info("bancos = ".$bancos);
            return Datatables::of($bancos)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    if ($mode == "show")
                    {
                        $actionBtn = ' <a onclick="verFirma($row->id_proveedor,$row->id_proveedor_firma_nac_extr);" class="view btn btn-primary btn-sm" title="ver firma">
                    <i class="fas fa-eye"></i></a>  ';
                        return $actionBtn;
                    }
                    else
                    {
                        $actionBtn = '<a class="view btn btn-warning btn-sm edit_banco" title="editar referencia bancaria" data-id-proveedor="'.$row->pivot->id_proveedor.'" data-id-banco="'.$row->id_banco.'">
                    <i class="fas fa-edit"></i></a> <a type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBaja" title="Dar de baja" data-tipo-baja="firma" data-id-proveedor="'.$row->pivot->id_proveedor.'" data-id-banco="'.$row->id_banco.'">
                    <i class="fas fa-exclamation-circle"></i></a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    //METODO PARA ELIMINAR LAS REFERENCIAS BANCARIAS DE LA BD - TABLA DEL EDITAR REGISTRO
    //Falta implementar.
    public function bajaReferenciaBancaria($id)
    {
        try {

            $banco = Proveedor_banco::findOrFail($id)->delete();

            return "success";

        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }


    //METODO PARA CREAR UNA REFERENCIA BANCARIA - TABLA DEL EDITAR REGISTRO
    //Falta implementar.
    public function crearReferenciaBancaria($id_proveedor, Request $request)
    {
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            Log::info("nombre banco gui =".$request->nombre_banco);
            $banco = Banco::where('nombre_banco',$request->nombre_banco)
                        ->first();
            Log::info("banco".$banco->nombre_banco);
            if($banco!=null)
            {
                $proveedor->bancos()->attach($banco, [  'id_localidad' => $request->localidad,
                                                        'tipo_cuenta' => $request->tipo_cuenta,
                                                        'nro_cuenta' => $request->nro_cuenta]);
            }

        } catch (\Exception $e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function verBanco($id_proveedor, $id_banco)
    {
        Log::info('si entra a ver banco con '.$id_proveedor. ' y '.$id_banco);
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('bancos');
            $banco=$proveedor->bancos->where('id_banco', $id_banco)->first();
            Log::info("banco".$banco);
            return $banco;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function actualizarBanco($id_proveedor, $id_banco, Request $request)
    {
        Log::info('si entra a actualizar banco con '.$id_proveedor. ' y '.$id_banco);
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('bancos');
            $banco=$proveedor->bancos->where('id_banco', $id_banco)->first();
            if($request->nombre_banco!='' && $request->localidad_sucursal!='' && $request->tipo_cuenta!='' && $request->nro_cuenta!='')
            {
                if($banco->nombre_banco==$request->nombre_banco)
                    $banco->pivot->update([ 'id_localidad'=>$request->localidad_sucursal,
                                            'tipo_cuenta'=>$request->tipo_cuenta,
                                            'nro_cuenta'=>$request->nro_cuenta]);
                else
                    return response()->json(['error'=>'No se puede actualizar el nombre del banco. Elimine la referencia bancaria y agregue una nueva.']);
            }

        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getActividades(Request $request, $id, $mode = null)
    {
        /*
        $data = Disposicion::join("disposiciones_act_prov", "disposiciones_act_prov.id_disposicion", "=", "disposiciones.id_disposicion")
                ->join("actividades_proveedores", "actividades_proveedores.id_actividad_proveedor", "=", "disposiciones_act_prov.id_actividad_proveedor")
                ->join("actividades_economicas", "actividades_economicas.id_actividad_economica", "=", "actividades_proveedores.id_actividad_economica" )
                ->join("tipos_actividades", "tipos_actividades.id_tipo_actividad", "=", "actividades_proveedores.id_tipo_actividad")
                ->where("disposiciones.id_proveedor", $id)
                ->select("disposiciones.nro_disposicion","actividades_economicas.cod_actividad", "tipos_actividades.desc_tipo_actividad", "actividades_economicas.agrupamiento","disposiciones.fecha_fin_vigencia","disposiciones.fecha_ini_vigencia", "actividades_economicas.desc_actividad")
                ->get();
        */ 
        $fecha=date('Y-m-d');
        try {
            $data = Disposicion::join("disposiciones_act_prov", "disposiciones_act_prov.id_disposicion", "=", "disposiciones.id_disposicion")
                ->join("actividades_proveedores", "actividades_proveedores.id_actividad_proveedor", "=", "disposiciones_act_prov.id_actividad_proveedor")
                ->join('actividades_economicas', 'actividades_proveedores.id_actividad_economica', '=', 'actividades_economicas.id_actividad_economica')
                ->join('tipos_actividades', 'actividades_proveedores.id_tipo_actividad', '=', 'tipos_actividades.id_tipo_actividad')
                ->whereDate("disposiciones.fecha_fin_vigencia", ">", $fecha)
                ->where("disposiciones.id_proveedor", $id)
                ->select('actividades_proveedores.id_actividad_economica', 'actividades_proveedores.id_actividad_proveedor', 'actividades_proveedores.id_tipo_actividad', 'actividades_economicas.desc_actividad','actividades_economicas.agrupamiento', 'actividades_economicas.cod_actividad', 'tipos_actividades.desc_tipo_actividad', 'disposiciones.fecha_fin_vigencia')
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

    public function getHistorialActividades(Request $request, $id, $mode = null)
    {
        try {
                $data = Disposicion::join("disposiciones_act_prov", "disposiciones_act_prov.id_disposicion", "=", "disposiciones.id_disposicion")
                ->join("actividades_proveedores", "actividades_proveedores.id_actividad_proveedor", "=", "disposiciones_act_prov.id_actividad_proveedor")
                ->join("actividades_economicas", "actividades_economicas.id_actividad_economica", "=", "actividades_proveedores.id_actividad_economica" )
                ->join("tipos_actividades", "tipos_actividades.id_tipo_actividad", "=", "actividades_proveedores.id_tipo_actividad")
                ->where("disposiciones.id_proveedor", $id)
                ->select("disposiciones.nro_disposicion","actividades_economicas.cod_actividad", "tipos_actividades.desc_tipo_actividad", "actividades_economicas.agrupamiento","disposiciones.fecha_fin_vigencia","disposiciones.fecha_ini_vigencia", "actividades_economicas.desc_actividad")
                ->get();
              
            return Datatables::of($data)
                ->addIndexColumn()

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
                /*if (Actividades_proveedores::where('id_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {

                    return Redirect::back()
                        ->withErrors(['Ya existe una actividad primaria, la operación no pudo completarse']);
                } else {/*/
                    $actividad = new Actividades_proveedores();
                    $actividad->id_proveedor = $id;
                    $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
                    $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

                    $actividad->save();

                    $Disposiciones_act_prov = new Disposiciones_act_prov();
                    $Disposiciones_act_prov->id_actividad_proveedor = $actividad->id_actividad_proveedor;
                    $Disposiciones_act_prov->id_disposicion = $request->disposiciones;

                    $Disposiciones_act_prov->save();

                    Log::info(Disposicion::find($request->disposiciones)->fecha_ini_vigencia);


                    return redirect()->back()->with('message', 'Actividad Creada Correctamente');
                //}
            } else {

                $actividad = new Actividades_proveedores();
                $actividad->id_proveedor = $id;
                $actividad->id_actividad_economica = $this->idActividad_economica($request->actividad_1);
                $actividad->id_tipo_actividad = $this->idtipos_actividades($request->tipo_actividad);

                $actividad->save();

                $Disposiciones_act_prov = new Disposiciones_act_prov();
                $Disposiciones_act_prov->id_actividad_proveedor = $actividad->id_actividad_proveedor;
                $Disposiciones_act_prov->id_disposicion = $request->disposiciones;

                $Disposiciones_act_prov->save();

                Log::info(Disposicion::find($request->disposiciones)->fecha_ini_vigencia);

                return redirect()->back()->with('message', 'Actividad Creada Correctamente');
            }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function crearPersona($id, Request $request)
    {

        try {
            //---------Carga de Persona----------

            $proveedor=Proveedor::findOrFail($id);
            $tipo_persona=htmlspecialchars($request->tipo_persona);
            switch($tipo_persona)
            {
                case 'miembro':
                    $proveedor->load('miembros');
                    $proveedor_personas=$proveedor->miembros;
                break;
                case 'direccion_firma':
                    $proveedor->load('miembrosDireccion_administradoresFirma');
                    $proveedor_personas=$proveedor->miembrosDireccion_administradoresFirma;
                break;
                case 'apoderado':
                    $proveedor->load('apoderados');
                    $proveedor_personas=$proveedor->apoderados;
                break;
            }
            $dni_persona=htmlspecialchars(str_replace(".","",$request->dni));
            $encontrado = false;
            foreach($proveedor_personas as &$proveedor_persona)
                if($proveedor_persona->dni_persona==$dni_persona)
                    $encontrado=true;
            if(!$encontrado)
            {
                $nombre_persona=htmlspecialchars($request->nombre);
                $apellido_persona=htmlspecialchars($request->apellido);
                if($dni_persona!='' && $nombre_persona!='' && $apellido_persona!='')
                {
                    $persona = Persona::where('dni_persona',$dni_persona)
                                                ->first();
                    if(!isset($persona))
                    {
                        Log::info("no existe persona ");
                        $persona = Persona::create([
                            'dni_persona' => $dni_persona,
                            //'cuil_persona'=>$proveedores_rupep->cuil_persona,
                            'nombre_persona' => $nombre_persona,
                            'apellido_persona' => $apellido_persona,
                            //'apellido_persona'=>$proveedores_rupep->apellido_persona,
                            //'genero_persona'=>$proveedores_rupep->genero_persona,
                        ]);
                    }
                    else
                    {
                        if($persona->nombre_persona!=$nombre_persona)
                            $persona->update(['nombre_persona'=>$nombre_persona]);
                        if($persona->apellido_persona!=$apellido_persona)
                            $persona->update(['apellido_persona'=>$apellido_persona]);
                    }

                    if($tipo_persona=='direccion_firma')
                    {
                        $cargo_persona = htmlspecialchars($request->cargo);
                        $proveedor->personas()->attach($persona, [  'rol_persona_proveedor' => $cargo_persona]);
                    }
                    $proveedor->personas()->attach($persona, [  'rol_persona_proveedor' => $tipo_persona]);
                }
            }

        }catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function actualizarPersona($id_proveedor, $tipo_persona, $id_persona, Request $request)
    {
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            switch($tipo_persona)
                {
                    case('miembro'):
                        $proveedor  ->load('miembros');
                        $persona=$proveedor->miembros->where('id_persona',$id_persona)->first();
                    break;
                    case('direccion_firma'):
                        $proveedor  ->load('miembrosDireccion_administradoresFirma');
                        $persona=$proveedor->miembrosDireccion_administradoresFirma->where('id_persona',$id_persona)->first();
                    break;
                    case('apoderados'):
                        $proveedor  ->load('apoderados');
                        $persona=$proveedor->apoderados->where('id_persona',$id_persona)->first();
                    break;
                }

            //---------Actualiza Persona----------

            $dni_persona=htmlspecialchars(str_replace(".","",$request->dni));
            $nombre_persona=htmlspecialchars($request->nombre);
            $apellido_persona=htmlspecialchars($request->apellido);

            if($dni_persona!='' && $nombre_persona!='' && $apellido_persona!='')
            {
                if($persona->dni_persona==$dni_persona)
                {
                    Log::info("dni persona igual");
                    if($persona->nombre_persona != $nombre_persona)
                        $persona->update(['nombre_persona'=>$nombre_persona]);
                    if($persona->apellido_persona != $apellido_persona)
                        $persona->update(['apellido_persona'=>$apellido_persona]);
                }
                else
                    Log::info("dni persona diferente");
            }

        }catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function eliminarPersona($id_proveedor, $tipo_persona, $id_persona, Request $request)
    {
        try
        {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            switch($tipo_persona)
                {
                    case('miembro'):
                        $proveedor  ->load('miembros');
                        $persona=$proveedor->miembros->where('id_persona',$id_persona)->first();
                        $proveedor->miembros()->detach($persona);
                    break;
                    case('direccion_firma'):
                        $proveedor  ->load('miembrosDireccion_administradoresFirma');
                        $persona=$proveedor->miembrosDireccion_administradoresFirma->where('id_persona',$id_persona)->first();
                        $proveedor->miembrosDireccion_administradoresFirma()->detach($persona);
                    break;
                    case('apoderado'):
                        $proveedor  ->load('apoderados');
                        $persona=$proveedor->apoderados->where('id_persona',$id_persona)->first();
                        $proveedor->apoderados()->detach($persona);
                    break;
                }
            }
        catch (\Exception$e)
        {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function getPersonas(Request $request, $tipo_persona, $id_proveedor, $mode = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id_proveedor);
            switch($tipo_persona)
            {
                case 'miembro':
                    $proveedor->load('miembros');
                    $personas = $proveedor->miembros;
                break;
                case 'direccion_firma':
                    $proveedor->load('miembrosDireccion_administradoresFirma');
                    $personas = $proveedor->miembrosDireccion_administradoresFirma;
                break;
                case 'apoderado':
                    $proveedor->load('apoderados');
                    $personas = $proveedor->apoderados;
                break;
            }
            return Datatables::of($personas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode, $tipo_persona) {
                    if ($mode == "show")
                    {
                        $actionBtn = ' <a onclick="verPersona($row->id_proveedor,$tipo_persona,$row->id_persona);" class="view btn btn-primary btn-sm" title="ver persona">
                    <i class="fas fa-eye"></i></a>  ';
                        return $actionBtn;
                    }
                    else
                    {
                        $actionBtn = '<a class="view btn btn-warning btn-sm edit_persona" title="editar persona" data-id-proveedor="'.$row->pivot->id_proveedor.'" data-tipo-persona="'.$tipo_persona.'" data-id-persona="'.$row->id_persona.'">
                    <i class="fas fa-edit"></i></a> <a type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBaja" title="Dar de baja" data-tipo-baja="persona" data-id-proveedor="'.$row->pivot->id_proveedor.'" data-tipo-persona="'.$tipo_persona.'" data-id-persona="'.$row->id_persona.'">
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

    public function verPersona($id_proveedor, $tipo_persona, $id_persona)
    {
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            switch($tipo_persona)
            {
                case('miembro'):
                    $proveedor  ->load('miembros');
                    $persona=$proveedor->miembros->where('id_persona',$id_persona)->first();
                break;
                case('direccion_firma'):
                    $proveedor  ->load('miembrosDireccion_administradoresFirma');
                    $persona=$proveedor->miembrosDireccion_administradoresFirma->where('id_persona',$id_persona)->first();
                break;
                case('apoderado'):
                    $proveedor  ->load('apoderados');
                    $persona=$proveedor->apoderados->where('id_persona',$id_persona)->first();
                break;
            }

            Log::info("persona=".$persona);
            return $persona;
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

    public function bajaActividades($id, Request $request)
    {
        try {
            /*if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
                return false;
            } else {*/
                //Actividades_proveedores::findOrFail($id)->delete();
                Log::info($request->nro_disposicion);

                $ap = Actividades_proveedores::findOrFail($id);
                $ap->ap_end_date = Carbon::now();
                $ap->save();

                $Disposiciones_act_prov = new Disposiciones_act_prov();
                $Disposiciones_act_prov->id_disposicion = $request->nro_disposicion;
                $Disposiciones_act_prov->id_actividad_proveedor = $ap->id_actividad_proveedor;
                //$Disposiciones_act_prov->start_date =Disposicion::find($request->nro_disposicion)->fecha_ini_vigencia;

                $Disposiciones_act_prov->save();

                //Prueba de baja agregando nuevo registro
                /*$actividad = new Actividades_proveedores();
                $actividad->id_proveedor = $ap->id_proveedor;
                $actividad->id_actividad_economica = $ap->id_actividad_economica;
                $actividad->id_tipo_actividad = $ap->id_tipo_actividad;
                $actividad->id_disposicion = 1 ; ///Falta creacion de modal para seleccion de disposicion, el id debe existir.
                $actividad->estado_cod = "BajaAP BD"; //mensaje de prueba a cambiar a futuro
                $actividad->ap_start_date = Carbon::now(); /// Se toma el Start Date de la disposicion, pero al no tener el modal, se deja la fecha actual como prueba.
                $actividad->ap_end_date = null;
                $actividad->save();*/


                return "success";
            //}
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function guardarActividades($id, Request $request)
    {
        try {
           // if (Actividades_proveedores::where('id_actividad_proveedor', $id)->where('id_tipo_actividad', 1)->exists()) {
               /* $actividad = Actividades_proveedores::find($id);
                $tipos_actividades = Tipo_actividad::All();
                $actividades = Actividad_economica::All();

                $actividad->update([
                    'id_actividad_economica' => $this->idActividad_economica($request->actividad_11),
                ]);

                $actividad->save();

                return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');*/

           // } else {

                $actividad = Actividades_proveedores::find($id);
                $tipos_actividades = Tipo_actividad::All();
                $actividades = Actividad_economica::All();

                $actividad->update([
                    'id_actividad_economica' => $this->idActividad_economica($request->actividad_11),
                ]);

                $actividad->save();

                return redirect()->back()->with('message', 'Los datos de la Actividad fueron modificados correctamente');
           // }
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function getFirmas(Request $request, $id_proveedor, $mode = null)
    {
        try {
            $proveedor = Proveedor::findOrFail($id_proveedor);
            $proveedor->load('firmas');
            $firmas = $proveedor->firmas;
            return Datatables::of($firmas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($mode) {
                    if ($mode == "show")
                    {
                        $actionBtn = ' <a onclick="verFirma($row->id_proveedor,$row->id_proveedor_firma_nac_extr);" class="view btn btn-primary btn-sm" title="ver firma">
                    <i class="fas fa-eye"></i></a>  ';
                        return $actionBtn;
                    }
                    else
                    {
                        $actionBtn = '<a class="view btn btn-warning btn-sm edit_firma" title="editar firma" data-id-proveedor="'.$row->id_proveedor.'" data-id-firma="'.$row->id_proveedor_firma_nac_extr.'">
                    <i class="fas fa-edit"></i></a> <a type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modalBaja" title="Dar de baja" data-tipo-baja="firma" data-id-proveedor="'.$row->id_proveedor.'" data-id-firma="'.$row->id_proveedor_firma_nac_extr.'">
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

    public function crearFirma($id_proveedor, Request $request)
    {
        Log::info("si entra a metodo crear firma");
        try {
            //---------Carga de Firma----------

            $denominacion=htmlspecialchars($request->denominacion);
            if($denominacion!='')
            {
                $proveedor=Proveedor::findOrFail($id_proveedor);
                $proveedor->load('firmas');
                $proveedor_firmas = $proveedor->firmas;
                $encontrado=false;
                foreach($proveedor_firmas as &$proveedor_firma)
                    if($proveedor_firma->denominacion_firma == $denominacion)
                        $encontrado=true;
                if(!$encontrado)
                {
                    $firma=Proveedor_firma_nac_extr::create([ 'id_proveedor'=>$id_proveedor,
                                                                'denominacion_firma'=>$denominacion/*,
                                                                'desc_firma'*/]);
                }
            }

        }catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function verFirma($id_proveedor, $id_firma)
    {
        Log::info('si entra a ver firma con '.$id_proveedor. ' y '.$id_firma);
        try {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('firmas');
            $firma=$proveedor->firmas->where('id_proveedor_firma_nac_extr', $id_firma)->first();
            Log::info("firma".$firma);
            return $firma;
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function actualizarFirma($id_proveedor, $id_firma, Request $request)
    {
        try {
            //---------Actualiza Firma----------

            $denominacion=htmlspecialchars($request->denominacion);

            if($denominacion!='')
            {
                $proveedor=Proveedor::findOrFail($id_proveedor);
                $proveedor->load('firmas');
                $firma = $proveedor->firmas->where('id_proveedor_firma_nac_extr', $id_firma)->first();
                $firma->update([ //'id_proveedor'=>$id_proveedor,
                                'denominacion_firma'=>$denominacion/*,
                                'desc_firma'*/]);
            }

        }catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function eliminarFirma($id_proveedor, $id_firma, Request $request)
    {
        try
        {
            $proveedor=Proveedor::findOrFail($id_proveedor);
            $proveedor->load('firmas');
            $firma = $proveedor->firmas->where('id_proveedor_firma_nac_extr', $id_firma)->first();
            $firma->delete();
            }
        catch (\Exception$e)
        {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }


    /*public function obtenerDatosProveedor($id){
    $proveedores_rupep = new Proveedor_rupae();
    $datos = $proveedores_rupep->obtenerProveedorRupaeId($id);
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

           /* $proveedor_domicilio_legal = Proveedor_domicilio::where('id_proveedor', $id)->where('tipo_domicilio', 'legal')
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
                ->get();*/

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


            $sucursales = Sucursal::where('id_proveedor', $id)->get();

            //return $sucursales;

            // $sucursales_email = Sucursal_email::where('id_sucursal', $sucursales[0]->id_sucursal)->get();

            // $sucursales_telefono = Sucursal_telefono::where('id_sucursal', $sucursales[0]->id_sucursal)->get();

            $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

            $pagos = Pago::where('id_proveedor', $id)->get();

            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();

            return view('editarRegistro', compact('paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades'), [
                'proveedor' => $proveedor,
                'id' => $id,
                'proveedor_telefono_fiscal' => $proveedor_telefono_fiscal,
                'proveedor_domicilio_fiscal' => $proveedor_domicilio_fiscal,
                'proveedor_email_fiscal' => $proveedor_email_fiscal,
               // 'proveedor_telefono_legal' => $proveedor_telefono_legal,
               // 'proveedor_domicilio_legal' => $proveedor_domicilio_legal,
               // 'proveedor_email_legal' => $proveedor_email_legal,
                'proveedor_telefono_real' => $proveedor_telefono_real,
                'proveedor_domicilio_real' => $proveedor_domicilio_real,
                'proveedor_email_real' => $proveedor_email_real,
                'proveedor_localidades_real' => $proveedor_localidades_real,
                'proveedor_provincias_real' => $proveedor_provincias_real,
              //  'proveedor_localidades_legal' => $proveedor_localidades_legal,
              //  'proveedor_provincias_legal' => $proveedor_provincias_legal,
                'proveedor_localidades_fiscal' => $proveedor_localidades_fiscal,
                'proveedor_provincias_fiscal' => $proveedor_provincias_fiscal,
                'actividades' => $actividades,
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
            $proveedor->load([  'domicilio_real',
                               // 'domicilio_legal',
                                'domicilio_fiscal',
                                'telefonos_real',
                               // 'telefonos_legal',
                                'telefonos_fiscal']);
            /* Se obtiene el representante del proveedor,
                * se agrega el indice porque la relación representante_actual
                * es una relación muchos a muchos y de esa relación se obtiene un array
                * con un unico registro de persona (ultimo representante del proveedor)
            * */

            $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

            $pagos = Pago::where('id_proveedor', $id)->get();

            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();
            $bancos = Banco::All();

            $mode = "edit";

            return view('editarRegistro', compact('tab', 'mode',
                'paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'proveedor',
                'id', 'actividades', 'bancos', 'pagos')
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

           // return response()->json($proveedor, 200);
            $proveedor->load([  'domicilio_real',
                              //  'domicilio_legal',
                               'domicilio_fiscal',
                                'telefonos_real',
                              // 'telefonos_legal',
                                'telefonos_fiscal',
                                'representante_actual'
                            ]);
           //return response()->json($proveedor, 200);
            $representante='';
            if($proveedor->representante_actual->isNotEmpty())
                $representante=$proveedor->representante_actual[0];


            $actividades = Actividades_proveedores::where('id_proveedor', $id)->get();

            $pagos = Pago::where('id_proveedor', $id)->get();
            $bancos = Proveedor_banco::where('id_proveedor', $id)->get();

            $paises = Pais::all();
            $provincias = Provincia::all();
            $localidades = Localidad::all();
            $tipos_actividades = Tipo_actividad::All();
            $actividades = Actividad_economica::All();
            $mode = "show";

            return view('verRegistro', compact('tab', 'mode',
                'paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'proveedor', 'representante',
                'id',  'actividades', 'pagos','bancos')
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
            if(!$cuit)
            {
                //Inicio de la transaccion
                DB::beginTransaction();

                $proveedor = Proveedor::find($id);
                $proveedor->load([  'representante_actual',
                                    'domicilio_real',
                                  //  'domicilio_legal',
                                    'domicilio_fiscal']);

                //---------Carga de Representante Legal----------

                $dni_persona= htmlspecialchars(str_replace(".","",$request->dni_legal));
                $representante = $proveedor->representante_actual->first();
                if($dni_persona!='')
                {
                    $persona=Persona::where('dni_persona', $dni_persona)
                                    ->first();
                    $nombre_persona= htmlspecialchars($request->nombre_persona);
                    $apellido_persona= htmlspecialchars($request->apellido_persona);

                    if($nombre_persona!='' && $apellido_persona!='')
                    {
                        if (!isset($representante)) {
                            if(!isset($persona))
                                $persona = Persona::create([
                                    'dni_persona' => $dni_persona,
                                    //'cuil_persona'=>$proveedores_rupep->cuil_persona,
                                    'nombre_persona' => $nombre_persona,
                                    'apellido_persona' => $apellido_persona,
                                    //'genero_persona'=>$proveedores_rupep->genero_persona,
                                ]);
                            else
                            {
                                if($persona->nombre_persona!=$nombre_persona)
                                    $persona->update(['nombre_persona' => $nombre_persona]);
                                if($persona->apellido_persona!=$apellido_persona)
                                    $persona->update(['apellido_persona' => $apellido_persona]);
                            }
                            $proveedor->personas()->attach($persona, ['rol_persona_proveedor' => 'Representante']);
                        }
                        else
                        {
                            if($representante->dni_persona!=$dni_persona)
                            {
                                $proveedor->representante_actual()->detach();
                                if($representante->proveedores->count()==0)
                                    $representante->delete();
                                if(!isset($persona))
                                    $persona = Persona::create([
                                        'dni_persona' => $dni_persona,
                                        //'cuil_persona'=>$proveedores_rupep->cuil_persona,
                                        'nombre_persona' => $nombre_persona,
                                        'apellido_persona' => $apellido_persona,
                                        //'genero_persona'=>$proveedores_rupep->genero_persona,
                                    ]);
                                else{
                                    if($persona->nombre_persona!=$nombre_persona)
                                        $persona->update(['nombre_persona' => $nombre_persona]);
                                    if($persona->apellido_persona!=$apellido_persona)
                                        $persona->update(['apellido_persona' => $apellido_persona]);
                                }
                                $proveedor->personas()->attach($persona, ['rol_persona_proveedor' => 'Representante']);
                            }
                            else
                            {
                                if($representante->nombre_persona!=$nombre_persona)
                                    $persona->update(['nombre_persona' => $nombre_persona]);
                                if($representante->apellido_persona!=$apellido_persona)
                                    $persona->update(['apellido_persona' => $apellido_persona]);
                            }
                        }
                    }
                }
                else
                {
                    if(isset($representante))
                    {
                        $proveedor->representante_actual()->detach();
                        if($representante->proveedores->count()==0)
                                    $representante->delete();
                    }
                }

                //----------------------------------Editar Domicilio Real---------------------------------------------

                $proveedor_domicilio_real = $proveedor->domicilio_real;
                Log::info('domicilio real='.$proveedor_domicilio_real);
                if($proveedor_domicilio_real=='')
                {
                    Log::info('crea domicilio real');
                    $this->crear_domicilio($proveedor->id_proveedor, 'real', $request);
                }
                else
                {
                    Log::info('actualiza domicilio real');
                    $this->actualizar_domicilio($proveedor_domicilio_real, 'real', $request);
                }

                //---------Crear Telefono_Real----------
                $this->actualizar_telefonos($proveedor->id_proveedor, 'real', $request);

                //---------Crear de Email_Real----------
                $this->actualizar_emails($proveedor->id_proveedor, 'real', $request);

                //----------------------------------Editar Domicilio Legal---------------------------------------------

               /* $proveedor_domicilio_legal = $proveedor->domicilio_legal;
                Log::info('domicilio legal='.$proveedor_domicilio_legal);
                if($proveedor_domicilio_legal=='')
                    $this->crear_domicilio($proveedor->id_proveedor, 'legal', $request);
                else
                    $this->actualizar_domicilio($proveedor_domicilio_legal, 'legal', $request);

                //---------Crear Telefono_Legal----------
                $this->actualizar_telefonos($proveedor->id_proveedor, 'legal', $request);

                //---------Crear de Email_Legal----------
                $this->actualizar_emails($proveedor->id_proveedor, 'legal', $request);*/

                //----------------------------------Editar Domicilio Fiscal---------------------------------------------

                $proveedor_domicilio_fiscal = $proveedor->domicilio_fiscal;
                Log::info('domicilio fiscal='.$proveedor_domicilio_fiscal);
                if($proveedor_domicilio_fiscal=='')
                    $this->crear_domicilio($proveedor->id_proveedor, 'fiscal', $request);
                else
                    $this->actualizar_domicilio($proveedor_domicilio_fiscal, 'fiscal', $request);

                //---------Crear Telefono_Fiscal----------
                $this->actualizar_telefonos($proveedor->id_proveedor, 'fiscal', $request);

                //---------Crear de Email_Fiscal----------
                $this->actualizar_emails($proveedor->id_proveedor, 'fiscal', $request);








                $proveedor = $proveedor->fill($request->all());
                $proveedor->cuit= str_replace("-","",$request->cuit);

                $proveedor->save();

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

                //Fin de la transaccion
                DB::commit();

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

    /*public function dar_baja(Request $request)
    {
        try {
            //Inicio de la transaccion
            DB::beginTransaction();
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupep = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupep);
            $proveedores_rupep->dado_de_baja = 1;
            $proveedores_rupep->save();

            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de baja el registro con el cuit: ' . $proveedores_rupep->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);
            //Fin de la transaccion
            DB::commit();
            return redirect()->back();

        } catch (\Exception$e) {
            //Si algo fallo, volvemos la transaccion atras
            DB::rollBack();

            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }*/

    public function dar_baja_id(Request $request)
    {
        try {
            //Inicio de la transaccion

            DB::beginTransaction();

            $id_disposicion = $request->nro_disposicion;
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupep = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupep);
           // $proveedores_rupep->dado_de_baja = 1;
            $proveedores_rupep->save();

            $actividades = DB::table('actividades_proveedores')->where('id_proveedor', $id_proveedor)->get();



           foreach($actividades as $clave => $actividad)
           {
            $Disposiciones_act_prov = new Disposiciones_act_prov();
            $Disposiciones_act_prov->id_actividad_proveedor = $actividad->id_actividad_proveedor;
            $Disposiciones_act_prov->id_disposicion = $id_disposicion;
            $Disposiciones_act_prov->save();
           }
            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de baja el registro con el cuit: ' . $proveedores_rupep->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);
            //Fin de la transaccion
            DB::commit();
            return redirect()->back();

        } catch (\Exception$e) {
            //Si algo fallo, volvemos la transaccion atras
            DB::rollBack();

            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }

    }

    public function dar_alta_id(Request $request)
    {
        try {
            //Inicio de la transaccion
            DB::beginTransaction();
            $id_proveedor = htmlspecialchars($request->id);
            $proveedores_rupep = Proveedor::find($id_proveedor);
            //return response()->json($proveedores_rupep);
            //$proveedores_rupep->dado_de_baja = 0;
            $proveedores_rupep->save();
            //Registro de LOG
            $responsable_id = User::findOrFail(auth()->id())->id;
            $responsable_nombre = User::findOrFail(auth()->id())->name;
            $responsable_email = User::findOrFail(auth()->id())->email;

            DB::connection('mysql')
            ->table('eventos_log')->insert(['EL_Evento' => 'Se ha dado de alta el registro con el cuit: ' . $proveedores_rupep->cuit . '.',
            'EL_Evento_Fecha' => Carbon::now(),
            'EL_Id_Responsable' => $responsable_id,
            'EL_Nombre_Responsable' => $responsable_nombre,
            'EL_Email_Responsable' => $responsable_email]);
            //Fin de la transaccion
            DB::commit();
            return redirect()->back();

        } catch (\Exception$e) {
            //Si algo fallo, volvemos la transaccion atras
            DB::rollBack();

            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

//ESTA FUNCION SE VA A UTILIZAR PARA ELIMINAR UN REGISTRO DE LA BD (FALTA TERMINAR DE IMPLEMENTAR)

public function eliminar_id(Request $request)
{
    Log::info('Entra a funcion eliminar_id');
    try {
        $id_proveedor = htmlspecialchars($request->id);
        $proveedor = Proveedor::findOrFail($id_proveedor);

        $proveedor->domicilios()->delete();

        $proveedor->telefonos()->delete();

        $personas=$proveedor->personas;
        $proveedor->personas()->detach();
        foreach($personas as $persona)
            if($persona->proveedores->count()==0)
                $persona->delete();

        $proveedor->actividades_economicas()->detach();

        $proveedor->tipos_actividades()->detach();

        $proveedor->emails()->delete();

        $proveedor->pagos()->delete();

        $proveedor->tipos_proveedor()->detach();

        $proveedor->delete();
        return redirect()->back();
    } catch (\Exception$e) {
        Log::error('Error inesperado.' . $e->getMessage());

        return Redirect::back()
            ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
    }

}

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

            $select = '<option value="">Seleccione una localidad</option>';
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

    public function getResponsable($dni){
        $personas=Persona::where('dni_persona', 'like', str_replace(".","",$dni).'%')
                ->get();
        /*$result='<ul id="personas-list">';
        foreach($personas as $persona){
            $result.= '<li onClick="selectPersona('.$persona->dni_persona.')">'.$persona->dni_persona.'</li>';
        }*/
        return $personas->map(function($persona){
                                return collect(['label'=>number_format($persona->dni_persona, 0, ",", "."),
                                                'value'=>number_format($persona->dni_persona, 0, ",", "."),
                                                'nombre_persona'=>$persona->nombre_persona,
                                                'apellido_persona'=>$persona->apellido_persona]);
                                });
    }

    public function obtenerListadoNoVigentes()
    {
        try {
         
            $fecha=date('Y-m-d');
            $data = Proveedor::join('disposiciones', 'proveedores.id_proveedor', '=', 'disposiciones.id_proveedor')
            ->select('razon_social', 'nombre_fantasia', 'cuit', 'disposicion_tipo','disposiciones.fecha_fin_vigencia', 'proveedores.id_proveedor')
           
            ->selectRaw('MAX(fecha_fin_vigencia) as fecha')
            ->where('disposicion_tipo', 'renovacion')
            ->orWhere('disposicion_tipo', 'inscripcion')
            ->orWhere('disposicion_tipo', 'baja')

            ->groupBy('proveedores.id_proveedor')
            ->get()

            ->where('fecha_fin_vigencia','<', $fecha);

            
            return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
            
        } catch (Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }

    public function obtenerListadoVigentes(Request $request)
    {
        try {
           /* $fecha=date('Y-m-d');
            $data = Proveedor::join('disposiciones', 'proveedores.id_proveedor', '=', 'disposiciones.id_proveedor')
            ->where(function($query){
                $query->where('disposiciones.disposicion_tipo', '=', 'inscripcion')
                ->orWhere('disposiciones.disposicion_tipo', '=', 'renovacion');
                })
            ->whereDate('fecha_fin_vigencia', '>=', $fecha)
            ->select("proveedores.nombre_fantasia", "proveedores.razon_social","proveedores.cuit", "disposiciones.fecha_fin_vigencia", "disposiciones.disposicion_tipo");
            
            
           $data->whereIn('fecha_fin_vigencia', function($queryBuilder){
                $queryBuilder->selectRaw('MAX(fecha_fin_vigencia)')
                ->from('disposiciones')
                ->groupBy('id_proveedor');

                //->groupBy('id_proveedor');
            })
            ->get();*/
            $fecha=date('Y-m-d');
            $data = Proveedor::join('disposiciones', 'proveedores.id_proveedor', '=', 'disposiciones.id_proveedor')
            ->select('razon_social', 'nombre_fantasia', 'cuit', 'disposicion_tipo','disposiciones.fecha_fin_vigencia', 'proveedores.id_proveedor')
           
            ->selectRaw('MAX(fecha_fin_vigencia) as fecha')
            ->where('disposicion_tipo', 'renovacion')
            ->orWhere('disposicion_tipo', 'inscripcion')

            ->groupBy('proveedores.id_proveedor')
            ->get()

            ->where('fecha_fin_vigencia','>', $fecha);
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
            
        } catch (\Exception$e) {
            Log::error('Error inesperado.' . $e->getMessage());

            return Redirect::back()
                ->withErrors(['Ocurrió un error, la operación no pudo completarse']);
        }
    }
}
