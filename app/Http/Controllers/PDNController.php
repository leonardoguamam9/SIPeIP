<?php

namespace App\Http\Controllers;

use App\Models\PDN;
use Illuminate\Http\Request;

class PDNController extends Controller
{
    public function index()
    {
        $pdns = PDN::all();
        return view('pdn.index', compact('pdns'));
    }

    public function create()
    {
        return view('pdn.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigoPDN' => 'required|string',
            'nombrePDN' => 'required|string',
            'descripcionPDN' => 'required|string',
            'estadoPDN' => 'required|string',
        ]);

        PDN::create($request->all());

        return redirect()->route('pdn.index')->with('success', 'PND creado correctamente');
    }
   
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $pdn = PDN::findOrFail($id);return view('pdn.edit', compact('pdn'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'codigoPDN' => 'required|string',
            'nombrePDN' => 'required|string',
            'descripcionPDN' => 'required|string',
            'estadoPDN' => 'required|string',
        ]);

        $pdn = PDN::findOrFail($id);
        $pdn->update($request->all());

        return redirect()->route('pdn.index')->with('success', 'PND actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $pdn = PDN::findOrFail($id);
        $pdn->delete();

        return redirect()->route('pdn.index')->with('success', 'PND eliminado correctamente');
    }
}