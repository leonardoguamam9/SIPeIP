<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OE;
use App\Models\PDN;
use App\Models\Entidad;

class OEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $oes = OE::with(['entidad', 'pdn'])->get();
         return view('oe.index', compact('oes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $entidades = Entidad::all();
        $pdns = PDN::all();
        return view('oe.create', compact('entidades', 'pdns'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'codigoOE' => 'required|string',
            'nombreOE' => 'required|string',
            'descripcionOE' => 'required|string',
            'estadoOE' => 'required|string',
            'entidad_id' => 'required|integer',
            'pdn_id' => 'required|integer',
        ]);

        OE::create($request->all());

        return redirect()->route('oe.index')->with('success', 'Objetivo Estratéjico  creado correctamente');
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
        $oe = OE::findOrFail($id);
        $entidades = Entidad::all();
        $pdns = PDN::all();
        return view('oe.edit', compact('oe', 'entidades', 'pdns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'codigoOE' => 'required|string',
            'nombreOE' => 'required|string',
            'descripcionOE' => 'required|string',
            'estadoOE' => 'required|string',
            'entidad_id' => 'required|integer',
            'pdn_id' => 'required|integer',
        ]);
        $oes = OE::findOrFail($id);
        $oes->update($request->all());

        return redirect()->route('oe.index')->with('success', 'Objetivo Estratégico actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $oes = OE::findOrFail($id);
        $oes->delete();

        return redirect()->route('oe.index')->with('success', 'Objetivo Estratégico eliminado correctamente');
    }
}
