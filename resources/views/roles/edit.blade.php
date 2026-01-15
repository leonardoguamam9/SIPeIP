@extends('layouts.app')

@section('title','Editar Rol')

@section('content')

<div class="container d-flex justify-content-center mt-4">

    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Rol</h4>

        <form method="POST" action="{{ route('roles.update', $role) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       class="form-control"
                       name="nombre"
                       value="{{ $role->nombre }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control"
                          name="descripcion"
                          rows="3"
                          required>{{ $role->descripcion }}</textarea>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('roles.index') }}"
                   class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

</div>

@endsection

