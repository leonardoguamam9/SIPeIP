<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Programa;
use App\Models\Auditoria;


class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('programa')->get();
        return view('proyecto.index', compact('proyectos'));
    }

    public function create()
    {
        $programas = Programa::all();
        return view('proyecto.create', compact('programas'));
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProyecto'=> 'required|string',
            'descripcionProyecto'=> 'required|string',
            'estadoProyecto'=> 'required|string',
            'responsableProyecto'=> 'required|string',
            'programa_id' => 'required|integer',
        ]);

         Proyecto::create($request->all());

         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'CREAR',
        'modulo' => 'PROYECTO',
        'descripcion' => 'Se creó un proyecto',
        'ip' => request()->ip()
        ]);

       
        return redirect()
            ->route('proyecto.index')
            ->with('success', 'Proyecto creado satisfactoriamente');
    }

    public function edit($id)
    {
        $proyecto  = Proyecto::findOrFail($id);
        $programas = Programa::all();

        return view('proyecto.edit', compact('proyecto', 'programas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreProyecto'=> 'required|string',
            'descripcionProyecto'=> 'required|string',
            'estadoProyecto'=> 'required|string',
            'responsableProyecto'=> 'required|string',
            'programa_id'=> 'required|integer',
        ]);

        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->all());

        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ACTUALIZAR',
        'modulo' => 'PROYECTO',
        'descripcion' => 'Se actualizó un proyecto',
        'ip' => request()->ip()
    ]);
        return redirect ()->route('proyecto.index')->with('success', 'Proyecto actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ELIMINAR',
        'modulo' => 'PROYECTO',
        'descripcion' => 'Se eliminó un proyecto',
        'ip' => request()->ip()
    ]);
        return redirect ()->route('proyecto.index')->with('success', 'Proyecto eliminado satisfactoriamente');

        
    }

     public function all()
    {
        return response()->json(
            Proyecto::select('id','nombreProyecto')->get()
        );
    }

     public function show($id)
    {
        $proyecto = Proyecto::with(['programa','indicadores'])->find($id);

        if(!$proyecto){
            return response()->json(['error'=>'Proyecto no encontrado'], 404);
        }

        return response()->json([
            'id' => $proyecto->id,
            'nombreProyecto' => $proyecto->nombreProyecto,
            'descripcionProyecto' => $proyecto->descripcionProyecto,
            'estadoProyecto' => $proyecto->estadoProyecto,
            'responsableProyecto' => $proyecto->responsableProyecto,
            'programa' => $proyecto->programa ? [
                'nombrePrograma' => $proyecto->programa->nombrePrograma,
                'tipoPrograma' => $proyecto->programa->tipoPrograma
            ] : null,
            'indicadores' => $proyecto->indicadores->map(function($ind){
                return [
                    'codigoIndicador' => $ind->codigoIndicador ?? '',
                    'nombreIndicador' => $ind->nombreIndicador ?? ''
                ];
            })
        ]);
    }
}