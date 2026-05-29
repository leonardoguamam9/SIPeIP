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
use App\Http\Controllers\ValidacionController;
use App\Http\Controllers\VisionGeneralController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ConfiguracionInstitucionalController;
use App\Http\Controllers\IntegracionFinanzasController;


Route::get('/sipeip/vision-general', [VisionGeneralController::class, 'index'])->name('sipeip.vision-general');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/entidades/list', [EntidadController::class, 'list']);
Route::get('/oe/list', [OEController::class, 'list']);
Route::get('/pdn/master', [PDNController::class, 'masterView'])->name('pdn.master');
Route::get('/pdns/list', [PDNController::class, 'list']);
Route::get('/pdns/{id}', [PDNController::class, 'show']);
Route::get('/pdns/{id}/oes', [OEController::class, 'forPDN']);
Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
Route::resource('configuracion', ConfiguracionInstitucionalController::class);
Route::resource('configuracion', ConfiguracionInstitucionalController::class);
Route::resource('finanzas', IntegracionFinanzasController::class);

Route::get('/auditorias', [AuditoriaController::class, 'index'])->name('auditorias.index');
Route::delete('/documentos/{documento}',
    [DocumentoController::class, 'destroy'])
    ->name('documentos.destroy');

Route::get('/documentos/{documento}/edit',
    [DocumentoController::class, 'edit'])
    ->name('documentos.edit');

Route::put('/documentos/{documento}',
    [DocumentoController::class, 'update'])
    ->name('documentos.update');

Route::get('/seguimientos',
    [SeguimientoController::class, 'index'])
    ->name('seguimientos.index');

Route::post('/seguimientos',
    [SeguimientoController::class, 'store'])
    ->name('seguimientos.store');

Route::delete('/seguimientos/{seguimiento}',
    [SeguimientoController::class, 'destroy'])
    ->name('seguimientos.destroy');

Route::get('/finanzas/pdf/export',
    [IntegracionFinanzasController::class, 'exportPdf'])
    ->name('finanzas.pdf');

// Traer todos los ODS para el select
Route::get('/ods/list', [ODSController::class, 'all']);

// Traer un ODS específico
Route::get('/ods/{id}', [ODSController::class, 'show']);

Route::get('/plans/list', [PlanController::class, 'all']);
Route::get('/plans/{id}', [PlanController::class, 'show']);

Route::get('/metas/list', [MetasController::class, 'all']);
Route::get('/metas/{id}', [MetasController::class, 'show']);

Route::get('/programas/list', [ProgramaController::class, 'all']);
Route::get('/programas/{id}', [ProgramaController::class, 'show']);

Route::get('/proyectos/list', [ProyectoController::class, 'all']);
Route::get('/proyectos/{id}', [ProyectoController::class, 'show']);

Route::get('/indicadores/list', [IndicadorController::class, 'all']);
Route::get('/indicadores/{id}', [IndicadorController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

//Rutas Protegidas por rol
Route::middleware('auth')->group(function () {

    // 🔑 ADMINISTRADOR → ACCESO TOTAL
    Route::middleware(['role:1'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('entidades', EntidadController::class);
    Route::resource('sipeip', VisionGeneralController::class);
    Route::get('/entidades/list', [EntidadController::class, 'list']);
    Route::get('/entidades/{id}', [EntidadController::class, 'show']);
    
    });
});

Route::middleware(['auth','role:1,4'])->group(function () {
    Route::resource('planes', PlanController::class);
    Route::resource('programa', ProgramaController::class);
    Route::resource('proyecto', ProyectoController::class);
    Route::resource('metas', MetasController::class);
    Route::resource('indicadores', IndicadoresController::class);
    Route::resource('ods', ODSController::class);
    Route::resource('oe', OEController::class);
    Route::resource('pdn', PDNController::class);
    Route::resource('alineacion', AlineacionController::class);
});

 
