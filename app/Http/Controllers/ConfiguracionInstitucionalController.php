<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionInstitucional;
use App\Models\Auditoria;
use Illuminate\Http\Request;

class ConfiguracionInstitucionalController extends Controller
{
    public function index()
    {
        $configuraciones = ConfiguracionInstitucional::all();

        return view('configuracion.index', compact('configuraciones'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        ConfiguracionInstitucional::create($request->all());

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'CREAR',
            'modulo' => 'CONFIGURACION',
            'descripcion' => 'Se registró configuración institucional',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Configuración guardada');
    }

    public function show(ConfiguracionInstitucional $configuracion)
    {
        //
    }

    public function edit(ConfiguracionInstitucional $configuracion)
    {
        return view('configuracion.edit', compact('configuracion'));
    }

    public function update(Request $request, ConfiguracionInstitucional $configuracion)
    {
        $request->validate([
            'nombreInstitucion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'periodoFiscal' => 'required',
            'responsable' => 'required'
        ]);

        $configuracion->update($request->all());

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'EDITAR',
            'modulo' => 'CONFIGURACION',
            'descripcion' => 'Se editó configuración institucional',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Configuración actualizada');
    }

    public function destroy(ConfiguracionInstitucional $configuracion)
    {
        $configuracion->delete();

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'ELIMINAR',
            'modulo' => 'CONFIGURACION',
            'descripcion' => 'Se eliminó la configuración institucional',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Configuración eliminada');
    }
}