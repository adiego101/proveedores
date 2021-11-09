<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedoresController;


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
    return view('nuevoRegistro');
});

Route::get('/gestionarRegistros', function () {
    return view('gestionarRegistros');
});

Route::get('registros/list', [ProveedoresController::class, 'getProveedores'])->name('registros.list');

Route::get('/Cambiar_contraseña', function () {
    return view('CambiarContraseña');
});

Route::group(['middleware' => ['auth']], function() {

    Route::post('/todos', [ProveedoresController::class,'todos'])->name('todos');


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class)->middleware(['can:admin_users']);
    Route::patch('/changePassword/{id}', 'App\Http\Controllers\UserController@changePassword')->name('changePassword');
});


//Prueba generacion PDF

Route::get('/registro-alta', 'App\Http\Controllers\RupaeController@descargarRegistroAlta');
Route::get('/certificado-inscripcion', 'App\Http\Controllers\RupaeController@descargarCertificadoInscripcion');
