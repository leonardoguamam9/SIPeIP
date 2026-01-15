@extends('layouts.app')

@section('title','Nuevo Rol')

@section('content')

<div class="container d-flex justify-content-center mt-4">

    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Crear Rol</h4>

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       class="form-control"
                       name="nombre"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control"
                          name="descripcion"
                          rows="3"
                          required></textarea>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">
                    Guardar
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
