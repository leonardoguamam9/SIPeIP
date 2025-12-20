<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Unique;


class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $entidades = Entidad :: all();
        return view('entidades.index', compact('entidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       return view('entidades.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombreEntidad'=>'required|string',
            'tipoEntidad'=>'required|string',
            'direccionEntidad'=>'required|string',
            'subSector'=>'required|string',
            'responsable'=>'required|string',
        ]);

        Entidad::create($request->all());

        return redirect()->route('entidades.index')->with('success',"Entidad creada satisfactoriamente");
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
        $entidad= Entidad::findOrFail($id);
        return view('entidades.edit',compact('entidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([
            'nombreEntidad'=>'required|string',
            'tipoEntidad'=>'required|string',
            'direccionEntidad'=>'required|string',
            'subSector'=>'required|string',
            'responsable'=>'required|string',
        ]);
        $entidad = Entidad::findOrFail($id);
        $entidad->update($request->all());
        return redirect()->route('entidades.index')->with('success',"Entidad actualizada satisfactoriamente");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //elinar un registro
         $entidades = Entidad::findOrFail($id);
         $entidades->delete();
         return redirect()->route('entidades.index')->with('success',"Entidad eliminada satisfactoriamente");
        

    }
}
