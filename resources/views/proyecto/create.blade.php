@extends('layouts.app')

@section('title','Crear Proyecto')

@section('content')

{{-- Contenedor principal que centra la tarjeta en toda la pantalla --}}
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Crear Proyecto Institucional</h4>

        <form action="{{ route('proyecto.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del Proyecto</label>
                <input type="text" name="nombreProyecto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Proyecto</label>
                <textarea name="descripcionProyecto" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado del Proyecto</label>
                <select name="estadoProyecto" class="form-control" required>
                    <option value="Borrador" selected>Borrador</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Responsable del Proyecto</label>
                <input type="text" name="responsableProyecto" class="form-control" required>
            </div>

            {{-- PROGRAMA --}}
            <div class="mb-3">
                <label class="form-label">Programa</label>
                <select name="programa_id" class="form-control" required>
                    <option value="">Seleccione un programa</option>
                    @foreach($programas as $programa)
                        <option value="{{ $programa->id }}">
                            {{ $programa->nombrePrograma }}
                        </option>
                    @endforeach
                </select>
            </div>

    
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">
                    Guardar Proyecto
                </button>
                
                <a href="{{ route('proyecto.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>

    </div>
</div>

@endsection