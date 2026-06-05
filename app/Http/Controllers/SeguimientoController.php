<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Proyecto;
use App\Models\Auditoria;

class SeguimientoController extends Controller
{
    public function index()
    {
        $seguimientos = Seguimiento::with('proyecto')->latest()->get();
        $proyectos = Proyecto::all();

        return view('seguimientos.index',
            compact('seguimientos', 'proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required',
            'avance' => 'required|integer|min:0|max:100',
            'fechaSeguimiento' => 'required',
            'estado' => 'required'
        ]);

        Seguimiento::create($request->all());

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'CREAR',
            'modulo' => 'SEGUIMIENTO',
            'descripcion' => 'Se registró seguimiento',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('seguimientos.index')
            ->with('success', 'Seguimiento registrado');
    }


    public function edit($id)
    {
        // Buscamos el seguimiento con su relación cargada
        $seguimiento = Seguimiento::with('proyecto')->findOrFail($id);
        
        return view('seguimientos.edit', compact('seguimiento'));
    }

    /**
     * Actualiza el registro en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'avance' => 'required|numeric|min:0|max:100',
            'observaciones' => 'required|string',
            'fechaSeguimiento' => 'required|date',
            'estado' => 'required|string',
        ]);

        $seguimiento = Seguimiento::findOrFail($id);
        
        $seguimiento->update([
            'avance' => $request->avance,
            'observaciones' => $request->observaciones,
            'fechaSeguimiento' => $request->fechaSeguimiento,
            'estado' => $request->estado,
        ]);

        return redirect()->route('seguimientos.index')->with('success', 'Seguimiento actualizado correctamente.');
    }

    public function destroy(Seguimiento $seguimiento)
    {
        $seguimiento->delete();

    return redirect()->route('seguimientos.index')
        ->with('success', 'El registro de seguimiento ha sido eliminado correctamente.');
}
    
}