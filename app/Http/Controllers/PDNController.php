<?php

namespace App\Http\Controllers;

use App\Models\PDN;
use App\Models\Entidad;  
use App\Models\User;
use Illuminate\Http\Request;

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

        // ✅ ASIGNAR USUARIO LOGUEADO
        $validated['users_id'] = auth()->id();

        PDN::create($validated);

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

        // ✅ MANTENER USUARIO
        $validated['users_id'] = auth()->id();

        $pdn = PDN::findOrFail($id);
        $pdn->update($validated);

        return redirect()->route('pdn.index')->with('success', 'PDN actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $pdn = PDN::findOrFail($id);
        $pdn->delete();

        return redirect()->route('pdn.index')->with('success', 'PDN eliminado correctamente');
    }
}
