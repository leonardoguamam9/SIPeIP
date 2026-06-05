<?php

namespace App\Http\Controllers;

use App\Models\PDN;
use App\Models\Entidad;  
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auditoria;

class PDNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pdns = PDN::with(['entidad', 'user'])->get();
        return view('pdn.index', compact('pdns'));
    }

    public function create()
    {
        $entidades = Entidad::all();
        $usuarios = User::all();

        return view('pdn.create', compact('entidades', 'usuarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigoPDN' => 'required|string|max:50',
            'nombrePDN' => 'required|string|max:255',
            'descripcionPDN' => 'nullable|string',
            'estadoPDN' => 'required|string',
            'anio_inicio' => 'required|integer',
            'anio_fin' => 'required|integer|gte:anio_inicio',
            'horizonte_planificacion' => 'required|string',
            'fecha_aprobacion' => 'nullable|date',
            'resolucion_aprobacion' => 'nullable|string',
            'entidad_id' => 'nullable|integer|exists:entidad,id',
            'responsable_pdn' => 'nullable|string',
            'documentoPDN' => 'nullable|string',
            'url_repositorio' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $validated['users_id'] = auth()->id();

        PDN::create($validated);

        // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'CREAR',
        'modulo' => 'Plan Nacional de Desarrollo',
        'descripcion' => 'Se creó un plan',
        'ip' => request()->ip()
        ]);

        return redirect()->route('pdn.index')
            ->with('success', 'PDN creado correctamente');
    }

    public function edit(string $id)
    {
        $pdn = PDN::findOrFail($id);
        $entidades = Entidad::all();
        $usuarios = User::all();

        return view('pdn.edit', compact('pdn','entidades','usuarios'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'codigoPDN' => 'required|string|max:50',
            'nombrePDN' => 'required|string|max:255',
            'descripcionPDN' => 'nullable|string',
            'estadoPDN' => 'required|string',
            'anio_inicio' => 'required|integer',
            'anio_fin' => 'required|integer|gte:anio_inicio',
            'horizonte_planificacion' => 'required|string',
            'fecha_aprobacion' => 'nullable|date',
            'resolucion_aprobacion' => 'nullable|string',
            'entidad_id' => 'nullable|integer|exists:entidad,id',
            'responsable_pdn' => 'nullable|string',
            'documentoPDN' => 'nullable|string',
            'url_repositorio' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $validated['users_id'] = auth()->id();

        $pdn = PDN::findOrFail($id);
        $pdn->update($validated);

        // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ACTUALIZAR',
        'modulo' => 'Plan Nacional de Desarrollo',
        'descripcion' => 'Se actualizo un plan',
        'ip' => request()->ip()
        ]);

         if ($request->filled('redirect')) {
        return redirect($request->redirect)
            ->with('success', 'PDN actualizado correctamente');
    }

   
    return redirect()->route('pdn.index')
        ->with('success', 'PDN actualizado correctamente');
        }

    public function destroy(string $id)
    {
        $pdn = PDN::findOrFail($id);
        $pdn->delete();

        // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ELIMINAR',
        'modulo' => 'Plan Nacional de Desarrollo',
        'descripcion' => 'Se elimino un plan',
        'ip' => request()->ip()
        ]);

        return redirect()->route('pdn.index')->with('success', 'PDN eliminado correctamente');
    }




public function masterView(Request $request)
{
    // 1. Mantenemos tu listado original de PDNs
    $pdns = PDN::all(); 

    // 2. Inicializamos la variable del reporte en null
    $reporteSeleccionado = null;

    // 3. Si en la URL viene el ID del botón "Detalle", buscamos el registro con sus relaciones
    if ($request->has('id')) {
        $reporteSeleccionado = \App\Models\ReporteMaestro::with(['entidad', 'pdn', 'plan', 'proyecto'])
            ->find($request->id);
    }

    // 4. Enviamos tanto tus PDNs como el reporte encontrado (si aplica) a la vista
    return view('pdn.master', compact('pdns', 'reporteSeleccionado'));
}

 public function list()
    {
        return response()->json(
            PDN::select(
                'id',
                'codigoPDN',
                'nombrePDN',
                'descripcionPDN',
                'estadoPDN'
            )->get()
        );
    }


    public function show($id)
{
    return response()->json(
        PDN::select(
            'id',
            'codigoPDN',
            'nombrePDN',
            'descripcionPDN',
            'estadoPDN',
            'anio_inicio',
            'anio_fin',
            'horizonte_planificacion',
            'fecha_aprobacion',
            'resolucion_aprobacion',
            'responsable_pdn',
            'documentoPDN',
            'url_repositorio',
            'observaciones'
        )->findOrFail($id)
    );
}


public function view()
{
    $reportes = \App\Models\ReporteMaestro::with(['entidad', 'pdn', 'plan', 'proyecto'])->get();

    return view('pdn.view', compact('reportes'));
}
    
}
