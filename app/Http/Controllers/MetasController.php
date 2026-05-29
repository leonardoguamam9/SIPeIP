<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metas;
use App\Models\OE;
use App\Models\Auditoria;

class MetasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $metas = Metas::all();
        return view('metas.index', compact('metas'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $oes = OE::all();
        return view('metas.create', compact('oes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'codigoMeta' => 'required|string',
        'nombreMeta' => 'required|string',
        'descripcionMeta' => 'required|string',
        'estadoMeta' => 'required|string',
        'oe_id' => 'required|exists:oes,id',
    ]);

    Metas::create([
        'codigoMeta' => $request->codigoMeta,
        'nombreMeta' => $request->nombreMeta,
        'descripcionMeta' => $request->descripcionMeta,
        'estadoMeta' => $request->estadoMeta,
        'oe_id' => $request->oe_id,
    ]);

      // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'CREAR',
        'modulo' => 'METAS',
        'descripcion' => 'Se creó una meta',
        'ip' => request()->ip()
        ]);

    return redirect()->route('metas.index')->with('success', 'Meta creada correctamente');
}
       

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
          $meta = Metas::with(['oe','indicadores'])->find($id);

        if(!$meta){
            return response()->json(['error'=>'Meta no encontrada'], 404);
        }

        return response()->json([
            'id' => $meta->id,
            'codigoMeta' => $meta->codigoMeta,
            'nombreMeta' => $meta->nombreMeta,
            'descripcionMeta' => $meta->descripcionMeta,
            'estadoMeta' => $meta->estadoMeta,
            'oe' => $meta->oe ? [
                'codigoOE' => $meta->oe->codigoOE,
                'nombreOE' => $meta->oe->nombreOE
            ] : null,
            'indicadores' => $meta->indicadores->map(function($ind){
                return [
                    'codigoIndicador' => $ind->codigoIndicador,
                    'nombreIndicador' => $ind->nombreIndicador
                ];
            })
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $meta = Metas::findOrFail($id);
        return view('metas.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([
            'codigoMeta'=>'required|string',
            'nombreMeta'=>'required|string',
            'descripcionMeta'=>'required|string',
            'estadoMeta'=>'required|string',
        ]);

        $meta = Metas::findOrFail($id);
        $meta->update($request->all());

          // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ACTUALIZAR',
        'modulo' => 'METAS',
        'descripcion' => 'Se actualizó una meta',
        'ip' => request()->ip()
        ]);


    
        if ($request->filled('redirect')) {
        return redirect($request->redirect)
            ->with('success', 'Meta actualizada correctamente');
    }


   
    return redirect()->route('metas.index')
        ->with('success', 'Meta actualizada correctamente');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $meta = Metas::findOrFail($id);
        $meta->delete();

        // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ELIMINAR',
        'modulo' => 'METAS',
        'descripcion' => 'Se eliminó una meta',
        'ip' => request()->ip()
        ]);


        return redirect()->route('metas.index')->with('success', 'Meta eliminada correctamente');
    }

     public function all()
    {
        
        return response()->json(
            Metas::select('id','nombreMeta')->get()
        );
    }
}
