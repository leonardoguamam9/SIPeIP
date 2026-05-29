<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
       return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'nombre' => 'required|unique:roles,nombre',
            'descripcion' => 'required',
        ]);

        Role::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'CREAR',
        'modulo' => 'ROL',
        'descripcion' => 'Se creó un rol',
        'ip' => request()->ip()
        ]);
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');;
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
         $role = Role::findOrFail($id);
         return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $role = Role::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:roles,nombre,' . $role->id,
            'descripcion' => 'required',
        ]);

        $role->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ACTUALIZO',
        'modulo' => 'ROL',
        'descripcion' => 'Se actualizo un rol',
        'ip' => request()->ip()
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Validación simple: no borrar roles con usuarios
        $role = Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'No se puede eliminar un rol asignado a usuarios');
        }

        $role->delete();
         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'Eliminar',
        'modulo' => 'ROL',
        'descripcion' => 'Se elimino un rol',
        'ip' => request()->ip()
        ]);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol eliminado correctamente');
       ;
    }
    };
