<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReporteWebController;

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

Route::view('/','index');
Route::view('contacto', 'contact');
Route::post('guardar-contacto',[ContactController::class, 'store']);
Route::group(['middleware' => ['auth']],function(){
    Route::get('leer-contactos',[ContactController::class,'index']);
    Route::get('leer-usuarios',[App\Http\Controllers\HomeController::class, 'users']);
    Route::get('crud',[App\Http\Controllers\HomeController::class, 'crud']);
    Route::get('reportes',[App\Http\Controllers\HomeController::class, 'reportes']);
    Route::get('moderadores',[App\Http\Controllers\HomeController::class, 'moderadores']);
    Route::get('cuentasbloqueadas',[App\Http\Controllers\HomeController::class, 'cuentasbloqueadas']);
    Route::get('solicitudes',[App\Http\Controllers\HomeController::class, 'solicitudes']);
    Route::get('/reportes', [ReporteWebController::class, 'index']);
    Route::get('/reportes/{id}', [ReporteWebController::class, 'show']);
    Route::patch('/reportes/{id}/status', [ReporteWebController::class, 'updateStatus'])->name('reportes.updateStatus');
    Route::get('/reportes', [ReporteWebController::class, 'index']);
    Route::get('/reportes/{id}', [ReporteWebController::class, 'show'])->name('reportes.show'); // Añadimos nombre
    Route::get('/reportes/{id}/edit', [ReporteWebController::class, 'edit'])->name('reportes.edit'); // NUEVA
    Route::put('/reportes/{id}', [ReporteWebController::class, 'update'])->name('reportes.update'); // NUEVA
    Route::patch('/reportes/{id}/status', [ReporteWebController::class, 'updateStatus'])->name('reportes.updateStatus');
    Route::delete('/reportes/{id}', [ReporteWebController::class, 'destroy'])->name('reportes.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
