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

        return view('nuevoRegistro', compact('cuit','paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades'));
    })->name('nuevoRegistro')->middleware(['can:crear_registros']);



    Route::get('/nuevoRegistroCuit', function () {

        return view('nuevoRegistroCuit');
    })->name('nuevoRegistroCuit')->middleware(['can:crear_registros']);




    Route::get('/gestionarRegistros', function () {
        return view('gestionarRegistros');
    })->middleware(['can:ver_registros']);

    Route::get('/baja', function () {
        return view('bajaRegistro');
    })->middleware(['can:baja_registros']);


    Route::post('/crear_registro_cuit', [ProveedoresController::class, 'crear_registro_cuit'])->name('crear_registro_cuit')->middleware(['can:crear_registros']);

    Route::get('registros/list', [ProveedoresController::class, 'getProveedores'])->name('registros.list');

    //Ruta para editar los registros, se llama desde el boton "editar" de la tabla.

    Route::get('/Cambiar_contraseña', function () {
        return view('CambiarContraseña');
    });

    Route::post('/crear_registro', [ProveedoresController::class, 'crear_registro'])->name('crear_registro')->middleware(['can:crear_registros']);
    //Levanta las vistas para editar (del formulario)
    Route::get('modificarRegistro/{id}/{tab?}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId')->name('modificarRegistro')->middleware(['can:editar_registros']);
    //Llama al metodo que realiza las modificaciones en la BD
    Route::post('editarProveedor/{id}', 'App\Http\Controllers\ProveedoresController@editarProveedor')->middleware(['can:editar_registros']);

    Route::get('verRegistro/{id}/{tab?}', 'App\Http\Controllers\ProveedoresController@verProveedorRupaeId')->name('verRegistro')->middleware(['can:ver_registros']);

    Route::get('bajaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_baja_id')->middleware(['can:baja_registros']);

    Route::get('altaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_alta_id')->middleware(['can:alta_registros']);

    //RUTA PARA ELIMINAR UN REGISTRO DE LA BD

    //Route::get('eliminarRegistro/{id}', 'App\Http\Controllers\ProveedoresController@eliminar_id');

    Route::post('/dar_baja', 'App\Http\Controllers\ProveedoresController@dar_baja')->middleware(['can:baja_registros']);

    Route::resource('roles', RoleController::class)->middleware(['can:admin_lista_roles']);
    Route::resource('users', UserController::class)->middleware(['can:admin_users']);
    Route::patch('/changePassword/{id}', 'App\Http\Controllers\UserController@changePassword')->name('changePassword')->middleware(['can:admin_users']);

    
    Route::group(['middleware' => ['can:editar_registros']], function () {

    Route::post('bajaPagos/{id}', 'App\Http\Controllers\ProveedoresController@bajaPagos')->name('pagos.baja');
    Route::post('bajaActividades/{id}', 'App\Http\Controllers\ProveedoresController@bajaActividades')->name('actividades.baja');

    Route::get('editarPagos/{id}', 'App\Http\Controllers\ProveedoresController@editarPagos')->name('pagos.editar');
    Route::get('editarActividades/{id}', 'App\Http\Controllers\ProveedoresController@editarActividades')->name('actividades.editar');

    Route::post('guardarPagos/{id}', 'App\Http\Controllers\ProveedoresController@guardarPagos')->name('pagos.guardar');
    Route::post('guardarActividades/{id}', 'App\Http\Controllers\ProveedoresController@guardarActividades')->name('actividades.guardar');

    Route::get('nuevoPagos/{id}', 'App\Http\Controllers\ProveedoresController@nuevoPagos')->name('pagos.nuevo');
    Route::get('nuevoActividades/{id}', 'App\Http\Controllers\ProveedoresController@nuevoActividades')->name('actividades.nuevo');

    Route::post('crearPagos/{id}', 'App\Http\Controllers\ProveedoresController@crearPagos')->name('pagos.crear');
    Route::post('crearActividades/{id}', 'App\Http\Controllers\ProveedoresController@crearActividades')->name('actividades.crear');

    Route::get('verPagos/{id}', 'App\Http\Controllers\ProveedoresController@verPagos')->name('pagos.ver');
    Route::get('verActividades/{id}', 'App\Http\Controllers\ProveedoresController@verActividades')->name('actividades.ver');

    });


    Route::get('localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    Route::get('localidadSelect/{id}', 'App\Http\Controllers\ProveedoresController@getLocalidadSelect');

    Route::get('modificarRegistro/localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    //Route::get('localidades_tabla/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidadesTabla');

    Route::get('Registro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');

    Route::get('idLocalidad/{nombre_localidad}', 'App\Http\Controllers\ProveedoresController@idLocalidad');

    Route::get('pagos/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getPagos')->name('pagos.list');

    //RUTA PARA OBTENER LAS FIRMAS NAC Y EXTR EN EL MODAL DE EDITAR. Todavia falta implementar.
    Route::get('firmas/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getDenominaciones')->name('denominaciones.list');

    Route::get('actividades/{id}/{mode?}', 'App\Http\Controllers\ProveedoresController@getActividades')->name('actividades.list');

    //Prueba generacion PDF

    Route::get('/registro-alta/{id}', 'App\Http\Controllers\RupaeController@descargarRegistroAlta');
    Route::get('/certificado-inscripcion/{id}', 'App\Http\Controllers\RupaeController@descargarCertificadoInscripcion');

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
    
});
