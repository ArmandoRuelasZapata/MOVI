<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReporteWebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FirebaseAuthController; // <-- Moví esta importación arriba con las demás
use App\Http\Controllers\HomeController;

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

// ==========================================
// Rutas Públicas
// ==========================================
Route::view('/', 'index');
Route::view('contacto', 'contact');
Route::post('guardar-contacto', [ContactController::class, 'store']);

// ==========================================
// RUTAS DE FIREBASE (Nuevas)
// ==========================================
// Esta es la ruta que recibe el Fetch desde JavaScript con el Token
Route::post('/firebase-login', [FirebaseAuthController::class, 'syncSession'])->name('firebase.login');


// ==========================================
// RUTAS PROTEGIDAS (Requieren sesión iniciada)
// ==========================================
Route::group(['middleware' => ['auth']], function() {
    
    // Vistas generales
    Route::get('leer-contactos', [ContactController::class, 'index']);
    Route::get('crud', [HomeController::class, 'crud']);
    Route::get('reportes-vista', [HomeController::class, 'reportes']); // Nota: Cambié el nombre a 'reportes-vista' para que no choque con tu Resource de abajo
    Route::get('moderadores', [HomeController::class, 'moderadores']);
    Route::get('cuentasbloqueadas', [HomeController::class, 'cuentasbloqueadas']);
    Route::get('solicitudes', [HomeController::class, 'solicitudes']);

    // Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/guardar', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('leer-usuarios', [HomeController::class, 'users']);

    // Reportes (Limpié las rutas duplicadas que tenías de reportes)
    Route::get('/reportes', [ReporteWebController::class, 'index']);
    Route::get('/reportes/{id}', [ReporteWebController::class, 'show'])->name('reportes.show'); 
    Route::get('/reportes/{id}/edit', [ReporteWebController::class, 'edit'])->name('reportes.edit'); 
    Route::put('/reportes/{id}', [ReporteWebController::class, 'update'])->name('reportes.update'); 
    Route::patch('/reportes/{id}/status', [ReporteWebController::class, 'updateStatus'])->name('reportes.updateStatus');
    Route::delete('/reportes/{id}', [ReporteWebController::class, 'destroy'])->name('reportes.destroy');
});

// ==========================================
// Autenticación por defecto
// ==========================================
// Mantenemos Auth::routes() porque Laravel lo necesita para poder cargar
// las vistas visuales de login.blade.php y register.blade.php cuando
// entras a la URL /login o /register en tu navegador.
Auth::routes();

// Ruta de inicio después de loguearse
Route::get('/home', [HomeController::class, 'index'])->name('home');