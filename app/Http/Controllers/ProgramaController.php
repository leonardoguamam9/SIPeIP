<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $programa = Programa :: all();
        return view('programa.index', compact('programa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          return view('programa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'nombrePrograma'=>'required|string',
            'tipoPrograma'=>'required|string',
            'descripcionPrograma'=>'required|string',
            'estadoPrograma'=>'required|string',
            'responsablePrograma'=>'required|string',
        ]);
         Programa::create($request->all());

        return redirect()->route('programa.index')->with('success',"Programa creada satisfactoriamente");
       
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
        $programa = Programa::findOrFail($id);
        return view('programa.edit',compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
          $request->validate([

            'nombrePrograma'=>'required|string',
            'tipoPrograma'=>'required|string',
            'descripcionPrograma'=>'required|string',
            'estadoPrograma'=>'required|string',
            'responsablePrograma'=>'required|string',
        ]);
         $programa = Programa::findOrFail($id);
        $programa->update($request->all());
        return redirect()->route('programa.index')->with('success',"Programa actualizada satisfactoriamente");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $programa = Programa::findOrFail($id);
         $programa->delete();
         return redirect()->route('programa.index')->with('success',"Programa eliminada satisfactoriamente");
        
    }
}
