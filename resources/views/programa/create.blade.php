@extends('layouts.app')

@section('title','Crear Programa')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Programa</h4>

        <form action="{{ route('programa.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del Programa</label>
                <input type="text" name="nombrePrograma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Programa</label>
                <input type="text" name="tipoPrograma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Programa</label>
                <input type="text" name="descripcionPrograma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado del Programa</label>
                <input type="text" name="estadoPrograma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Responsable del Programa</label>
                <input type="text" name="responsablePrograma" class="form-control" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">
                    Guardar Programa
                </button>

                <a href="{{ route('programa.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection

