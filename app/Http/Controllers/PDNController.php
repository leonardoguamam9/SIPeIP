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

        $validated['users_id'] = auth()->id();

        $pdn = PDN::findOrFail($id);
        $pdn->update($validated);

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

        return redirect()->route('pdn.index')->with('success', 'PDN eliminado correctamente');
    }




    public function masterView()
{
    $pdns = PDN::all(); // SOLO listar
    return view('pdn.master', compact('pdns'));
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


    
}
