<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Proyecto;
use App\Models\Pdn;
use App\Models\Plan;
use App\Models\Auditoria;

class DocumentoController extends Controller
{
    // Mostrar vista
    public function index()
    {
        $documentos = Documento::latest()->get();
        $proyectos = Proyecto::all();
        $pdns = Pdn::all();
        $planes = Plan::all();

        return view('documentos.index', compact(
            'documentos',
            'proyectos',
            'pdns',
            'planes'
        ));
    }

    // Guardar documento
    public function store(Request $request)
    {
        $request->validate([
            'nombreDocumento' => 'required',
            'archivoDocumento' => 'required|file|mimes:pdf,doc,docx,xlsx'
        ]);

        $archivo = $request->file('archivoDocumento');
        $ruta = $archivo->store('documentos', 'public');

        Documento::create([
            'nombreDocumento' => $request->nombreDocumento,
            'archivoDocumento' => $ruta,
            'modulo' => $request->modulo,
            'modulo_id' => $request->modulo_id
        ]);

        // AUDITORIA CREAR
        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'CREAR',
            'modulo' => 'DOCUMENTO',
            'descripcion' => 'Se subió un documento',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('documentos.index')
            ->with('success', 'Documento subido correctamente');
    }

    // Editar Documento
public function edit(Documento $documento)
{
    $pdns = Pdn::all();
    $planes = Plan::all();
    $proyectos = Proyecto::all();

    return view('documentos.edit', compact(
        'documento',
        'pdns',
        'planes',
        'proyectos'
    ));
}

public function update(Request $request, Documento $documento)
{
    $request->validate([
        'nombreDocumento' => 'required',
        'modulo' => 'required',
        'modulo_id' => 'required'
    ]);

    $documento->update([
        'nombreDocumento' => $request->nombreDocumento,
        'modulo' => $request->modulo,
        'modulo_id' => $request->modulo_id
    ]);

    Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'EDITAR',
        'modulo' => 'DOCUMENTO',
        'descripcion' => 'Se editó un documento',
        'ip' => request()->ip()
    ]);

    return redirect()
        ->route('documentos.index')
        ->with('success', 'Documento actualizado');
}


   
    // Eliminar documento
    public function destroy(Documento $documento)
    {
        $documento->delete();

        // AUDITORIA ELIMINAR
        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'ELIMINAR',
            'modulo' => 'DOCUMENTO',
            'descripcion' => 'Se eliminó un documento',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('documentos.index')
            ->with('success', 'Documento eliminado');
    }
}