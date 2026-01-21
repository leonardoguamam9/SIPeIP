<?php

namespace App\Http\Controllers;

use App\Models\Indicadores;
use App\Models\Metas;
use Illuminate\Http\Request;

class IndicadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $indicadores = Indicadores::with('meta')->get();
        return view('indicadores.index', compact('indicadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $metas = Metas::all();
         return view('indicadores.create', compact('metas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'codigoIndicador'=> 'required',
            'nombreIndicador'=> 'required',
            'descripcionIndicador'=> 'required',
            'tipoIndicador'=>'required',
            'formulaIndicador'=>'required',
            'estadoIndicador'=>'required',
            'meta_id'=>'required',
        ]);

        Indicadores::create($request->all());
        return redirect()->route('indicadores.index')->with('success', 'Indicador creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $indicador = Indicadores::with('meta')->find($id);

        if(!$indicador){
            return response()->json(['error'=>'Indicador no encontrado'], 404);
        }

        return response()->json([
            'id' => $indicador->id,
            'codigoIndicador' => $indicador->codigoIndicador,
            'nombreIndicador' => $indicador->nombreIndicador,
            'descripcionIndicador' => $indicador->descripcionIndicador,
            'tipoIndicador' => $indicador->tipoIndicador,
            'formulaIndicador' => $indicador->formulaIndicador,
            'estadoIndicador' => $indicador->estadoIndicador,
            'meta' => $indicador->meta ? [
                'codigoMeta' => $indicador->meta->codigoMeta,
                'nombreMeta' => $indicador->meta->nombreMeta
            ] : null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $indicador = Indicadores::findOrFail($id);
         $metas = Metas::all();
         return view('indicadores.edit', compact('indicador', 'metas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'codigoIndicador'=>'required',
            'nombreIndicador'=>'required',
            'descripcionIndicador'=>'required',
            'tipoIndicador'=>'required',
            'formulaIndicador'=>'required',
            'estadoIndicador'=>'required',
            'meta_id'=>'required',
        ]);
          $indicador = Indicadores::findOrFail($id);
          $indicador->update($request->all());
         if ($request->filled('redirect')) {
        return redirect($request->redirect)
            ->with('success', 'Indicador actualizado correctamente');
    }
    return redirect()->route('indicadores.index')
        ->with('success', 'Indicador actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $indicador = Indicadores::findOrFail($id);
         $indicador->delete();
         return redirect()->route('indicadores.index')->with('success', 'Indicador eliminado correctamente');
    }

    public function all()
    {
        return response()->json(
            Indicadores::select('id','nombreIndicador')->get()
        );
    }
}
