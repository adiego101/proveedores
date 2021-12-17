<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedoresController;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Localidad;
use App\Models\Tipo_actividad;
use App\Models\Actividad_economica;
use App\Models\Jerarquia_compre_local;
use App\Models\Producto;
use App\Models\Ponderacion_compre_local;


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

Route::group(['middleware' => ['auth']], function() {

    Route::post('/crear_registro', [ProveedoresController::class,'crear_registro'])->name('crear_registro');
    //Levanta las vistas para editar (del formulario)
    Route::get('modificarRegistro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');
    //Llama al metodo que realiza las modificaciones en la BD
    Route::post('editarProveedor/{id}', 'App\Http\Controllers\ProveedoresController@editarProveedor');

    Route::post('/dar_baja', 'App\Http\Controllers\ProveedoresController@dar_baja');
    Route::get('bajaRegistro/{id}', 'App\Http\Controllers\ProveedoresController@dar_baja_id');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class)->middleware(['can:admin_users']);
    Route::patch('/changePassword/{id}', 'App\Http\Controllers\UserController@changePassword')->name('changePassword');

    Route::get('localidades/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidades');
    //Route::get('localidades_tabla/{provincia}', 'App\Http\Controllers\ProveedoresController@getLocalidadesTabla');
});


Route::get('Registro/{id}', 'App\Http\Controllers\ProveedoresController@obtenerProveedorRupaeId');

Route::get('idLocalidad/{nombre_localidad}', 'App\Http\Controllers\ProveedoresController@idLocalidad');

//Prueba generacion PDF
Route::get('/registro-alta', 'App\Http\Controllers\RupaeController@descargarRegistroAlta');
Route::get('/certificado-inscripcion', 'App\Http\Controllers\RupaeController@descargarCertificadoInscripcion');
