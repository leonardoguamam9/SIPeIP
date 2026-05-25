<?php

namespace App\Http\Controllers;

use App\Models\IntegracionFinanzas;
use App\Models\Auditoria;
use App\Models\Entidad;
use Illuminate\Http\Request;

class IntegracionFinanzasController extends Controller
{
    public function index()
{
    $integraciones = IntegracionFinanzas::all();
    $entidades = Entidad::all();

    return view('finanzas.index', compact('integraciones', 'entidades'));
}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigoIntegracion' => 'required',
            'entidad_id' => 'required',
            'montoPresupuesto' => 'required',
            'fechaEnvio' => 'required',
            'estado' => 'required'
        ]);

        IntegracionFinanzas::create($request->all());

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'CREAR',
            'modulo' => 'FINANZAS',
            'descripcion' => 'Se registró integración financiera',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('finanzas.index')
            ->with('success', 'Registro guardado');
    }

    public function edit(IntegracionFinanzas $finanza)
{
    $entidades = Entidad::all();

    return view('finanzas.edit', compact('finanza', 'entidades'));
}

    public function update(Request $request, IntegracionFinanzas $finanza)
    {
    $request->validate([
        'entidad_id' => 'required',
        'montoPresupuesto' => 'required',
        'estadoTransferencia' => 'required'
    ]);

        $finanza->update($request->all());

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'EDITAR',
            'modulo' => 'FINANZAS',
            'descripcion' => 'Se editó integración financiera',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('finanzas.index')
            ->with('success', 'Registro actualizado');
    }


    public function destroy(IntegracionFinanzas $finanza)
    {
        $finanza->delete();

        Auditoria::create([
            'user_id' => auth()->id(),
            'accion' => 'ELIMINAR',
            'modulo' => 'FINANZAS',
            'descripcion' => 'Se eliminó integración financiera',
            'ip' => request()->ip()
        ]);

        return redirect()
            ->route('finanzas.index')
            ->with('success', 'Registro eliminado');
    }
}