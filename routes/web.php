<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CalificacionesController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
});
Route::get('/inicio', function () {
    return view('inicio');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/form',[HomeController::class,'form']);
route::post('/add_alumno',[HomeController::class,'add_alumno']);
route::get('/show_alumno',[HomeController::class,'show_alumno']);
route::get('delete_alumno/{id}',[HomeController::class,'delete_alumno']);
route::get('update_alumno/{id}',[HomeController::class,'update_alumno']);
route::post('edit_alumno/{id}',[HomeController::class,'edit_alumno']);
Route::get('/buscar-usuarios', [HomeController::class, 'buscar'])->name('buscar_usuarios');
Route::post('/registrar-asistencias', [AsistenciaController::class, 'store'])->name('asistencia.store');
Route::get('/registrar-asistencias', [AsistenciaController::class, 'index'])->name('asistencia.index');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/calificaciones', [CalificacionesController::class, 'index'])->name('calificaciones.index');

Route::get('/capturar-calificaciones', [CalificacionesController::class, 'capturar'])->name('capturar_calificaciones');
Route::post('/guardar-calificaciones', [CalificacionesController::class, 'guardar'])->name('guardar_calificaciones');

Route::get('/buscar-alumnos', [CalificacionesController::class, 'buscarAlumnos'])->name('buscar_alumnos');
Route::get('/asistencias', [AsistenciaController::class, 'visualizar'])->name('asistencias.visualizar');
Route::get('/buscar', [AsistenciaController::class, 'buscar'])->name('buscar');
Route::get('/altaDocente', [RegisterController::class, 'index'])->name('altaDocente');
Route::post('/altaDocente', [RegisterController::class, 'store'])->name('altaDocente.store');

