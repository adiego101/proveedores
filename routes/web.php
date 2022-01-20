<?php

use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Actividad_economica;
use App\Models\Jerarquia_compre_local;
use App\Models\Localidad;
use App\Models\Pais;
use App\Models\Ponderacion_compre_local;
use App\Models\Producto;
use App\Models\Provincia;
use App\Models\Tipo_actividad;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/nuevoRegistro', function () {
    $paises = Pais::all();
    $provincias = Provincia::all();
    $localidades = Localidad::all();
    $tipos_actividades = Tipo_actividad::All();
    $actividades = Actividad_economica::All();
    $productos = Producto::All();
    $ponderaciones = Ponderacion_compre_local::All();
    $jerarquias = Jerarquia_compre_local::All();
    return view('nuevoRegistro', compact('paises', 'provincias', 'localidades', 'tipos_actividades', 'actividades', 'productos', 'ponderaciones', 'jerarquias'));
});

Route::get('/gestionarRegistros', function () {
    return view('gestionarRegistros');
});

Route::get('/baja', function () {
    return view('bajaRegistro');
});

Route::get('registros/list', [ProveedoresController::class, 'getProveedores'])->name('registros.list');

//Ruta para editar los registros, se llama desde el boton "editar" de la tabla.

Route::get('/Cambiar_contraseña', function () {
    return view('CambiarContraseña');
});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/crear_registro', [ProveedoresController::class, 'crear_registro'])->name('crear_registro');
    //Levanta las vistas para editar (del formulario)
    Route::get('modificarRegistro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');
    //Llama al metodo que realiza las modificaciones en la BD
    Route::post('editarProveedor/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');

    Route::get('verRegistro/{id}', 'App\Http\Controllers\ProveedoresController@verProveedorRupaeId');

    Route::get('bajaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_baja_id');

    Route::post('/dar_baja', 'App\Http\Controllers\ProveedoresController@dar_baja');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class)->middleware(['can:admin_users']);
    Route::patch('/changePassword/{id}', 'App\Http\Controllers\UserController@changePassword')->name('changePassword');

    Route::get('localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    Route::get('localidadSelect/{id}', 'App\Http\Controllers\ProveedoresController@getLocalidadSelect');

    Route::get('modificarRegistro/localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    //Route::get('localidades_tabla/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidadesTabla');

    Route::get('Registro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');

    Route::get('idLocalidad/{nombre_localidad}', 'App\Http\Controllers\ProveedoresController@idLocalidad');

    Route::get('sucursales/{id}', 'App\Http\Controllers\ProveedoresController@getSucursales')->name('sucursales.list');
    Route::get('pagos/{id}', 'App\Http\Controllers\ProveedoresController@getPagos')->name('pagos.list');
    Route::get('actividades/{id}', 'App\Http\Controllers\ProveedoresController@getActividades')->name('actividades.list');
    Route::get('productos/{id}', 'App\Http\Controllers\ProveedoresController@getProductos')->name('productos.list');
    Route::get('patentes/{id}', 'App\Http\Controllers\ProveedoresController@getPatentes')->name('patentes.list');
    Route::get('seguros/{id}', 'App\Http\Controllers\ProveedoresController@getSeguros')->name('seguros.list');
    Route::get('sedes/{id}', 'App\Http\Controllers\ProveedoresController@getSedes')->name('sedes.list');

    Route::post('bajaSucursales/{id}', 'App\Http\Controllers\ProveedoresController@bajaSucursales')->name('sucursales.baja');
    Route::post('bajaPagos/{id}', 'App\Http\Controllers\ProveedoresController@bajaPagos')->name('pagos.baja');
    Route::post('bajaActividades/{id}', 'App\Http\Controllers\ProveedoresController@bajaActividades')->name('actividades.baja');
    Route::post('bajaProductos/{id}', 'App\Http\Controllers\ProveedoresController@bajaProductos')->name('productos.baja');
    Route::post('bajaPatentes/{id}', 'App\Http\Controllers\ProveedoresController@bajaPatentes')->name('patentes.baja');
    Route::post('bajaSeguros/{id}', 'App\Http\Controllers\ProveedoresController@bajaSeguros')->name('seguros.baja');
    Route::post('bajaSedes/{id}', 'App\Http\Controllers\ProveedoresController@bajaSedes')->name('sedes.baja');

    Route::get('editarSucursales/{id}', 'App\Http\Controllers\ProveedoresController@editarSucursales')->name('sucursales.editar');
    Route::get('editarPagos/{id}', 'App\Http\Controllers\ProveedoresController@editarPagos')->name('pagos.editar');
    Route::get('editarActividades/{id}', 'App\Http\Controllers\ProveedoresController@editarActividades')->name('actividades.editar');
    Route::get('editarProductos/{id}', 'App\Http\Controllers\ProveedoresController@editarProductos')->name('productos.editar');
    Route::get('editarPatentes/{id}', 'App\Http\Controllers\ProveedoresController@editarPatentes')->name('patentes.editar');
    Route::get('editarSeguros/{id}', 'App\Http\Controllers\ProveedoresController@editarSeguros')->name('seguros.editar');
    Route::get('editarSedes/{id}', 'App\Http\Controllers\ProveedoresController@editarSedes')->name('sedes.editar');

    Route::post('guardarSucursales/{id}', 'App\Http\Controllers\ProveedoresController@guardarSucursales')->name('sucursales.guardar');
    Route::post('guardarPagos/{id}', 'App\Http\Controllers\ProveedoresController@guardarPagos')->name('pagos.guardar');
    Route::post('guardarActividades/{id}', 'App\Http\Controllers\ProveedoresController@guardarActividades')->name('actividades.guardar');
    Route::post('guardarProductos/{id}', 'App\Http\Controllers\ProveedoresController@guardarProductos')->name('productos.guardar');
    Route::post('guardarPatentes/{id}', 'App\Http\Controllers\ProveedoresController@guardarPatentes')->name('patentes.guardar');
    Route::post('guardarSeguros/{id}', 'App\Http\Controllers\ProveedoresController@guardarSeguros')->name('seguros.guardar');
    Route::post('guardarSedes/{id}', 'App\Http\Controllers\ProveedoresController@guardarSedes')->name('sedes.guardar');

    Route::get('verSucursales/{id}', 'App\Http\Controllers\ProveedoresController@verSucursales')->name('sucursales.ver');
    Route::get('verPagos/{id}', 'App\Http\Controllers\ProveedoresController@verPagos')->name('pagos.ver');
    Route::get('verActividades/{id}', 'App\Http\Controllers\ProveedoresController@verActividades')->name('actividades.ver');
    Route::get('verProductos/{id}', 'App\Http\Controllers\ProveedoresController@verProductos')->name('productos.ver');
    Route::get('verPatentes/{id}', 'App\Http\Controllers\ProveedoresController@verPatentes')->name('patentes.ver');
    Route::get('verSeguros/{id}', 'App\Http\Controllers\ProveedoresController@verSeguros')->name('seguros.ver');
    Route::get('verSedes/{id}', 'App\Http\Controllers\ProveedoresController@verSedes')->name('sedes.ver');

//Prueba generacion PDF

    Route::get('/registro-alta/{id}', 'App\Http\Controllers\RupaeController@descargarRegistroAlta');
    Route::get('/certificado-inscripcion/{id}', 'App\Http\Controllers\RupaeController@descargarCertificadoInscripcion');

});
