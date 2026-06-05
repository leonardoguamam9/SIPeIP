@extends('layouts.app')

@section('title','Crear Plan')

@section('content')

{{-- Contenedor principal para centrar la tarjeta de forma vertical y horizontal --}}
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Plan Institucional</h4>

        <form action="{{ route('planes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del Plan</label>
                <input type="text" name="nombrePlan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Plan</label>
                <textarea name="descripcionPlan" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado del Plan</label>
                <select name="estadoPlan" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="Borrador">Borrador</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Cerrado">Cerrado</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fechaInicio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fechaFin" class="form-control" required>
            </div>

            {{-- Relación con Entidad --}}
            <div class="mb-3">
                <label class="form-label">Entidad</label>
                <select name="entidad_id" class="form-control" required>
                    <option value="">Seleccione una entidad</option>
                    @foreach($entidades as $entidad)
                        <option value="{{ $entidad->id }}">
                            {{ $entidad->nombreEntidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones de acción unificados --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">
                    Guardar Plan
                </button>
                
                <a href="{{ route('planes.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection