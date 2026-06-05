<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\MetasController;
use App\Http\Controllers\IndicadoresController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\ODSController;
use App\Http\Controllers\OEController;
use App\Http\Controllers\PDNController;
use App\Http\Controllers\AlineacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ConfiguracionInstitucionalController;
use App\Http\Controllers\IntegracionFinanzasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReporteMaestroController;
use App\Http\Controllers\VisionGeneralController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Landing Page y Accesos Abiertos)
|--------------------------------------------------------------------------
*/

// Nueva Página de Inicio (Home Page) del SIPeIP
Route::get('/', function () {
    return view('welcome'); 
});

// Rutas de la API interna para selectores dinámicos y consultas asíncronas
Route::get('/entidades/list', [EntidadController::class, 'list']);
Route::get('/oe/list', [OEController::class, 'list']);
Route::get('/pdns/list', [PDNController::class, 'list']);
Route::get('/pdns/{id}', [PDNController::class, 'show']);
Route::get('/pdns/{id}/oes', [OEController::class, 'forPDN']);
Route::get('/ods/list', [ODSController::class, 'all']);
Route::get('/plans/list', [PlanController::class, 'all']);
Route::get('/plans/{id}', [PlanController::class, 'show']);
Route::get('/metas/list', [MetasController::class, 'all']);
Route::get('/programas/list', [ProgramaController::class, 'all']);
Route::get('/programas/{id}', [ProgramaController::class, 'show']);
Route::get('/proyectos/list', [ProyectoController::class, 'all']);
Route::get('/proyectos/{id}', [ProyectoController::class, 'show']);
Route::get('/indicadores/list', [IndicadoresController::class, 'all']);

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación General (Cualquier usuario logueado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Panel Principal (Dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión Documental y Evidencias
    Route::resource('documentos', DocumentoController::class)->except(['create', 'show']);
    
    // Monitoreo y Seguimiento Técnico
    Route::resource('seguimientos', SeguimientoController::class)->except(['create', 'show']);
    Route::get('/seguimientos/{id}/edit', [SeguimientoController::class, 'edit'])->name('seguimientos.edit');
    Route::put('/seguimientos/{id}', [SeguimientosController::class, 'update'])->name('seguimientos.update');

    // Reportes Maestros Consolidados
    Route::post('/panel-maestro/guardar', [ReporteMaestroController::class, 'guardar'])->name('panel.maestro.guardar');
    Route::post('/reporte-maestros/guardar', [ReporteMaestroController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Roles Específicos
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 🔑 ADMINISTRADOR (Rol ID: 1) → Seguridad, Auditoría y Configuración del Núcleo
    Route::middleware(['role:1'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('entidades', EntidadController::class);
        Route::resource('sipeip', VisionGeneralController::class);
        Route::resource('configuracion', ConfiguracionInstitucionalController::class);
        Route::resource('finanzas', IntegracionFinanzasController::class);
        
        Route::get('/sipeip/vision-general', [VisionGeneralController::class, 'index'])->name('sipeip.vision-general');
        Route::get('/auditorias', [AuditoriaController::class, 'index'])->name('auditorias.index');
        Route::get('/finanzas/pdf/export', [IntegracionFinanzasController::class, 'exportPdf'])->name('finanzas.pdf');
        Route::get('/entidades/{id}', [EntidadController::class, 'show']);
        Route::get('/pdn/master', [PDNController::class, 'masterView'])->name('pdn.master');
        Route::get('/pdn/view', [PDNController::class, 'view'])->name('pdn.viewview');
    });

    // 📈 PLANIFICADORES Y ADMINISTRADORES (Roles ID: 1 y 4) → Formulación de Proyectos e Indicadores
    Route::middleware(['role:1,4'])->group(function () {
        Route::resource('planes', PlanController::class);
        Route::resource('programa', ProgramaController::class);
        Route::resource('proyecto', ProyectoController::class);
        Route::resource('metas', MetasController::class);
        Route::resource('indicadores', IndicadoresController::class);
        Route::resource('ods', ODSController::class);
        Route::resource('oe', OEController::class);
        Route::resource('pdn', PDNController::class);
        Route::resource('alineacion', AlineacionController::class);
        Route::get('/pdn/view', [PDNController::class, 'view'])->name('pdn.view');
        
        // Vistas de detalle e interconexiones para la formulación
        Route::get('/pdn/master', [PDNController::class, 'masterView'])->name('pdn.master');
        Route::get('/metas/{id}', [MetasController::class, 'show']);
        Route::get('/indicadores/{id}', [IndicadoresController::class, 'show']);
        Route::get('/ods/{id}', [ODSController::class, 'show']);
        Route::get('/pdn/view', [PDNController::class, 'view'])->name('pdn.view');
    });
});

// Carga automática de las rutas de autenticación de Laravel Breeze / Jetstream (Login, Register, Logout)
require __DIR__.'/auth.php';