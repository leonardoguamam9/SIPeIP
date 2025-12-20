@extends('layouts.app')

@section('title','Crear Entidad')

@section('content')

<div class="card shadow p-4" style="width: 100%; max-width: 450px;">

    <h4 class="text-center mb-4">Crear Entidad Institucional</h4>

    <form action="{{ route('entidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre de la Entidad</label>
            <input type="text" name="nombreEntidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Entidad</label>
            <input type="text" name="tipoEntidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección de la Entidad</label>
            <input type="text" name="direccionEntidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Subsector</label>
            <input type="text" name="subSector" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Responsable</label>
            <input type="text" name="responsable" class="form-control" required>
        </div>

        <div class="d-grid">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>

</div>

@endsection

