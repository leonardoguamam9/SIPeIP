@extends('layouts.app')

@section('title','Nuevo Usuario')

@section('content')

<div class="container d-flex justify-content-center mt-4">

    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Crear Usuario</h4>

        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                       name="email"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select class="form-control" name="role_id" required>
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}">
                            {{ $r->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password"
                       class="form-control"
                       name="password"
                       required>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">
                    Guardar
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
