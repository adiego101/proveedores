<?php

use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Actividad_economica;
use App\Models\Localidad;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Tipo_actividad;
use App\Models\Sector;
use App\Models\Banco;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(["register" => false]);

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');

Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {


    Route::get('/nuevoRegistro/{cuit?}', function ($cuit = null) {
        $paises = Pais::all();
        $provincias = Provincia::all();
        $localidades = Localidad::all();
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();
        $mode = "create";
        $bancos = Banco::all();

        return view('nuevoRegistro', compact('cuit','paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'bancos','mode'));
    })->name('nuevoRegistro')->middleware(['can:crear_registros']);



    Route::get('/nuevoRegistro2/{id}', function ($id) {
        $mode = "edit";
        $tipos_actividades = Tipo_actividad::All();
        $actividades = Actividad_economica::All();


        return view('nuevoRegistro2',compact('id','mode','tipos_actividades','actividades'));
    })->name('nuevoRegistro2')->middleware(['can:crear_registros']);

    Route::get('/nuevoRegistroCuit', function () {

        return view('nuevoRegistroCuit');
    })->name('nuevoRegistroCuit')->middleware(['can:crear_registros']);


    Route::get('/nuevaDisposicion', function () {
        $mode = "create";

        return view('disposiciones.create', compact('mode'));
    })->name('disposiciones.create')->middleware(['can:crear_registros']);

    Route::get('/nuevaActividad', function () {
        $mode = "create";

        return view('actividades.create', compact('mode'));
    })->name('actividades.create')->middleware(['can:crear_registros']);

    Route::get('/gestionarRegistros', function () {
        return view('gestionarRegistros');
    })->middleware(['can:ver_registros']);

    Route::get('/gestionarRegistrosII', function () {
        return view('gestionarRegistrosII');
    })->middleware(['can:ver_registros']);
  

    Route::get('/baja', function () {
        return view('bajaRegistro');
    })->middleware(['can:baja_registros']);


    Route::post('/crear_registro_cuit', [ProveedoresController::class, 'crear_registro_cuit'])->name('crear_registro_cuit')->middleware(['can:crear_registros']);

    Route::get('registros/list', [ProveedoresController::class, 'getProveedores'])->name('registros.list');

    Route::get('registros/listII', [ProveedoresController::class, 'getProveedoresII'])->name('registros.listII');


    //Ruta para editar los registros, se llama desde el boton "editar" de la tabla.

    Route::get('/Cambiar_contraseña', function () {
        return view('CambiarContraseña');
    });

    Route::post('/crear_registro', [ProveedoresController::class, 'crear_registro'])->name('crear_registro')->middleware(['can:crear_registros']);
    //Levanta las vistas para editar (del formulario)
    Route::get('modificarRegistro/{id}/{tab?}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId')->name('modificar.Registro')->middleware(['can:editar_registros']);
    //Llama al metodo que realiza las modificaciones en la BD
    Route::post('editarProveedor/{id}', 'App\Http\Controllers\ProveedoresController@editarProveedor')->name('proveedor.editar')->middleware(['can:editar_registros']);

    Route::get('verRegistro/{id}/{tab?}', 'App\Http\Controllers\ProveedoresController@verProveedorRupaeId')->name('verRegistro')->middleware(['can:ver_registros']);

    Route::POST('bajaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_baja_id')->middleware(['can:baja_registros']);

    Route::get('altaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_alta_id')->middleware(['can:alta_registros']);

    //RUTA PARA ELIMINAR UN REGISTRO DE LA BD

    //Route::get('eliminarRegistro/{id}', 'App\Http\Controllers\ProveedoresController@eliminar_id');

    Route::post('/dar_baja', 'App\Http\Controllers\ProveedoresController@dar_baja')->middleware(['can:baja_registros']);

    Route::resource('roles', RoleController::class)->middleware(['can:admin_lista_roles']);
    Route::resource('users', UserController::class)->middleware(['can:admin_users']);
    Route::patch('/changePassword', 'App\Http\Controllers\UserController@changePassword')->name('changePassword');


    Route::group(['middleware' => ['can:editar_registros']], function () {

    Route::post('bajaPagos/{id}', 'App\Http\Controllers\ProveedoresController@bajaPagos')->name('pagos.baja');
    Route::post('bajaActividades/{id}', 'App\Http\Controllers\ProveedoresController@bajaActividades')->name('actividades.baja');
    Route::post('proveedor/{id_proveedor}/firma/{id_firma}/eliminar', 'App\Http\Controllers\ProveedoresController@eliminarFirma')->name('firmas.eliminar');
    Route::post('proveedor/{id_proveedor}/{tipo_persona}/{id_persona}/eliminar', 'App\Http\Controllers\ProveedoresController@eliminarPersona')->name('personas.eliminar');

    Route::get('editarPagos/{id}', 'App\Http\Controllers\ProveedoresController@editarPagos')->name('pagos.editar');
    Route::get('editarActividades/{id}', 'App\Http\Controllers\ProveedoresController@editarActividades')->name('actividades.editar');

    Route::post('guardarPagos/{id}', 'App\Http\Controllers\ProveedoresController@guardarPagos')->name('pagos.guardar');
    Route::post('guardarActividades/{id}', 'App\Http\Controllers\ProveedoresController@guardarActividades')->name('actividades.guardar');
    Route::post('proveedor/{id_proveedor}/firma/{id_persona}/actualizar', 'App\Http\Controllers\ProveedoresController@actualizarFirma')->name('firmas.actualizar');
    Route::post('proveedor/{id_proveedor}/banco/{id_banco}/actualizar', 'App\Http\Controllers\ProveedoresController@actualizarBanco')->name('bancos.actualizar');
    Route::post('proveedor/{id_proveedor}/disposicion/{id_disposicion}/actualizar', 'App\Http\Controllers\ProveedoresController@actualizarDisposicion')->name('disposiciones.actualizar');
    Route::post('proveedor/{id_proveedor}/{tipo_persona}/{id_persona}/actualizar', 'App\Http\Controllers\ProveedoresController@actualizarPersona')->name('personas.actualizar');


    Route::get('nuevoPagos/{id}', 'App\Http\Controllers\ProveedoresController@nuevoPagos')->name('pagos.nuevo');
    Route::get('nuevoActividades/{id}', 'App\Http\Controllers\ProveedoresController@nuevoActividades')->name('actividades.nuevo');

    Route::post('crearPagos/{id}', 'App\Http\Controllers\ProveedoresController@crearPagos')->name('pagos.crear');
    Route::post('crearActividades/{id}', 'App\Http\Controllers\ProveedoresController@crearActividades')->name('actividades.crear');
    Route::post('crearPersona/{id}', 'App\Http\Controllers\ProveedoresController@crearPersona')->name('personas.crear');
    Route::post('crearFirma/{id}', 'App\Http\Controllers\ProveedoresController@crearFirma')->name('firmas.crear');

    Route::get('verPagos/{id}', 'App\Http\Controllers\ProveedoresController@verPagos')->name('pagos.ver');
    Route::get('verActividades/{id}', 'App\Http\Controllers\ProveedoresController@verActividades')->name('actividades.ver');

    Route::get('proveedor/disposicionesJson/{id_proveedor}/{tipo?}', 'App\Http\Controllers\ProveedoresController@getDisposicionesJson')->name('disposiciones.json');
    Route::get('proveedor/{id_proveedor}/nro_disposicion/{nro_disposicion}', 'App\Http\Controllers\ProveedoresController@getNroDisposiciones')->name('disposiciones.nroslist');
    Route::get('proveedor/{id_proveedor}/disposiciones/{mode?}', 'App\Http\Controllers\ProveedoresController@getDisposiciones')->name('disposiciones.list');
    Route::post('proveedor/{id_proveedor}/disposicion/guardar', 'App\Http\Controllers\ProveedoresController@crearDisposicion')->name('disposiciones.crear');

    Route::get('proveedor/{id_proveedor}/disposicion/{id_disposicion}/editar', 'App\Http\Controllers\ProveedoresController@verDisposicion')->name('disposiciones.ver');

    Route::get('proveedor/{id_proveedor}/firma/{id_firma}/editar', 'App\Http\Controllers\ProveedoresController@verFirma')->name('firmas.ver');
    Route::get('proveedor/{id_proveedor}/banco/{id_banco}/editar', 'App\Http\Controllers\ProveedoresController@verBanco')->name('bancos.ver');
    Route::get('proveedor/{id_proveedor}/{tipo_persona}/{id_persona}/editar', 'App\Http\Controllers\ProveedoresController@verPersona')->name('personas.ver');

    });


    Route::get('localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    Route::get('localidadSelect/{id}', 'App\Http\Controllers\ProveedoresController@getLocalidadSelect');

    Route::get('modificarRegistro/localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    //Route::get('localidades_tabla/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidadesTabla');

    Route::get('Registro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');

    Route::get('idLocalidad/{nombre_localidad}', 'App\Http\Controllers\ProveedoresController@idLocalidad');

    Route::get('pagos/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getPagos')->name('pagos.list');

    //RUTA PARA OBTENER LAS REFERENCIAS BANCARIAS EN EL MODAL DE EDITAR. Todavia falta implementar.
    Route::get('referenciasBancarias/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getReferenciasBancarias')->name('referenciasBancarias.list');

    //RUTA PARA ELIMINAR LAS REFERENCIAS BANCARIAS EN EL MODAL DE BAJA DEL EDITAR. Todavia falta implementar.
    Route::post('bajaReferenciasBancarias/{id}', 'App\Http\Controllers\ProveedoresController@bajaReferenciaBancaria')->name('referenciasBancarias.baja');

    //RUTA PARA CREAR UNA REFERENCIA BANCARIA EN EL MODAL DE ALTA DEL EDITAR. Todavia falta implementar.
    Route::post('proveedor/{id_proveedor}/banco/store', 'App\Http\Controllers\ProveedoresController@crearReferenciaBancaria')->name('referenciasBancarias.crear');

    Route::get('actividades/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getActividades')->name('actividades.list');
    Route::get('historialActividades/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getHistorialActividades')->name('historialActividades.list');
    Route::get('personas/{tipo_persona}/{id_proveedor}/{mode?}', 'App\Http\Controllers\ProveedoresController@getPersonas')->name('personas.list');
    Route::get('firmas/{id_proveedor}/{mode?}', 'App\Http\Controllers\ProveedoresController@getFirmas')->name('firmas.list');


    //Prueba generacion PDF


    Route::get('/nuevo-registro/{id}', 'App\Http\Controllers\RupaeController@nuevoRegistroAlta');
    Route::get('/nuevo-certificado/{id}', 'App\Http\Controllers\RupaeController@nuevoCertificadoInscripcion');

    Route::get('/excel', function () {
        /*ini_set('memory_limit','1024M');
        set_time_limit(0);*/
        $paises = Pais::all();
        $provincias = Provincia::all();
        $sectores = Sector::all();
        $actividades_economicas=Actividad_economica::all();
        return view('exportarExcel',compact('paises','provincias','sectores','actividades_economicas'));
    })->middleware(['can:descargar_excel']);


    Route::get('responsable/{dni}', 'App\Http\Controllers\ProveedoresController@getResponsable')->name('responsable');
    Route::get('/exportar', 'App\Http\Controllers\ExportController@exportar')->name('exportar')->middleware(['can:descargar_excel']);
    Route::post('limpiar', 'App\Http\Controllers\ProveedoresController@limpiar')->name('limpiar');

    //Ruta del registro de LOGs
    Route::get('/historial_acciones', function () {
        return view('historialAcciones');
    })->middleware(['can:consultar_historial_acciones']);

    Route::get('/listado_acciones', 'App\Http\Controllers\ProveedoresController@obtenerListadoAcciones')->name('listado_acciones')->middleware(['can:consultar_historial_acciones']);

    //Lista de proveedores Vigentes - No vigentes
    
    Route::get('/proveedores_no_vigentes', function () {
        return view('listadoProveedoresNoVigentes');
    });
    Route::get('listado_p_no_vigentes', [ProveedoresController::class, 'obtenerListadoNoVigentes'])->name('listado.proveedoresNoVigentes');

    Route::get('/proveedores_vigentes', function () {
        return view('listadoProveedoresVigentes');
    });
    Route::get('listado_p_vigentes', [ProveedoresController::class, 'obtenerListadoVigentes'])->name('listado.proveedoresVigentes');

});
