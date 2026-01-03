<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\ODS;

class ODSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $ods = ODS :: all();
        return view('ods.index', compact('ods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombreODS'=>'required|string',
            'tipoODS'=>'required|string',
            'descripcionODS'=>'required|string',
        ]);

        ODS::create($request->all());

        return redirect()->route('ods.index')->with('success',"ODS creada satisfactoriamente");
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
        $ods = ODS::findOrFail($id);
        return view('ods.edit',compact('ods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([   
            'nombreODS'=>'required|string',
            'tipoODS'=>'required|string',
            'descripcionODS'=>'required|string',
        ]);
         $ods = ODS::findOrFail($id);
         $ods->update($request->all());
         return redirect()->route('ods.index')->with('success',"ods actualizada satisfactoriamente");
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $ods = ODS::findOrFail($id);
         $ods->delete();
         return redirect()->route('ods.index')->with('success',"ODS eliminada satisfactoriamente");
        
    }
}
