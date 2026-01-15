@extends('layouts.app')

@section('title','Editar Usuario')

@section('content')

<div class="container d-flex justify-content-center mt-4">

    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Usuario</h4>

        <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{ $usuario->name }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                       name="email"
                       value="{{ $usuario->email }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select class="form-control" name="role_id" required>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}"
                            {{ $usuario->role_id == $r->id ? 'selected' : '' }}>
                            {{ $r->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('usuarios.index') }}"
                   class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
