@extends('layouts.app')

@section('title','Editar Entidad')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Entidad Institucional</h4>

        <form action="{{ route('entidades.update', $entidad->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre de la Entidad</label>
                <input type="text"
                       name="nombreEntidad"
                       class="form-control"
                       value="{{ $entidad->nombreEntidad }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Entidad</label>
                <input type="text"
                       name="tipoEntidad"
                       class="form-control"
                       value="{{ $entidad->tipoEntidad }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección de la Entidad</label>
                <input type="text"
                       name="direccionEntidad"
                       class="form-control"
                       value="{{ $entidad->direccionEntidad }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subsector</label>
                <input type="text"
                       name="subSector"
                       class="form-control"
                       value="{{ $entidad->subSector }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Responsable</label>
                <input type="text"
                       name="responsable"
                       class="form-control"
                       value="{{ $entidad->responsable }}"
                       required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('entidades.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
