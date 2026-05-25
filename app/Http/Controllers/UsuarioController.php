<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Auditoria;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $usuarios = User::with('role')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'role_id'=>'required|exists:roles,id',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'role_id'=> $request->role_id,
            'password'=> Hash::make($request->password),
        ]);

         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'CREAR',
        'modulo' => 'USUARIO',
        'descripcion' => 'Se creó un usuario',
        'ip' => request()->ip()
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
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
        $usuario = User::findOrFail($id);
        $roles = Role::all();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $usuario = User::findOrFail($id);

        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|email|unique:users,email,' . $usuario->id,
            'role_id'=> 'required|exists:roles,id',
        ]);

        $usuario->update($request->only('name', 'email', 'role_id'));

         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ACTUALIZAR',
        'modulo' => 'USUARIO',
        'descripcion' => 'Se actualizo un usuario',
        'ip' => request()->ip()
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
          $usuario = User::findOrFail($id);
        $usuario->delete();

         // AUDITORIA
        Auditoria::create([
        'user_id' => auth()->id(),
        'accion' => 'ELIMINO',
        'modulo' => 'USUARIO',
        'descripcion' => 'Se elimino un usuario',
        'ip' => request()->ip()
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
