<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metas;
use App\Models\OE;

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

    return redirect()->route('metas.index')->with('success', 'Meta creada correctamente');
}
       

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        return redirect()->route('metas.index')->with('success', 'Meta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $meta = Metas::findOrFail($id);
        $meta->delete();

        return redirect()->route('metas.index')->with('success', 'Meta eliminada correctamente');
    }
}
