@extends('layouts.app')

@section('title','Editar Seguimiento')

@section('content')

{{-- Contenedor Flexbox para centrar la tarjeta vertical y horizontalmente --}}
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Editar Seguimiento de Planificación</h4>

        <form action="{{ route('seguimientos.update', $seguimiento->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Directiva obligatoria para actualizar --}}

            {{-- Proyecto (Deshabilitado para evitar alterar la relación base, se envía oculto si es necesario) --}}
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Proyecto</label>
                <input type="text" class="form-control" value="{{ $seguimiento->proyecto->nombreProyecto }}" disabled>
            </div>

            {{-- Avance --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Avance (%)</label>
                <input type="number" 
                       name="avance" 
                       class="form-control" 
                       value="{{ old('avance', $seguimiento->avance) }}" 
                       min="0" 
                       max="100" 
                       required>
            </div>

            {{-- Observaciones --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea name="observaciones" 
                          class="form-control" 
                          rows="3" 
                          required>{{ old('observaciones', $seguimiento->observaciones) }}</textarea>
            </div>

            {{-- Fecha --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Fecha</label>
                <input type="date" 
                       name="fechaSeguimiento" 
                       class="form-control" 
                       value="{{ old('fechaSeguimiento', $seguimiento->fechaSeguimiento) }}" 
                       required>
            </div>

            {{-- Estado --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="En Proceso" {{ $seguimiento->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="Finalizado" {{ $seguimiento->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                    <option value="Retrasado" {{ $seguimiento->estado == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                </select>
            </div>

           
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    Actualizar Seguimiento
                </button>
                <a href="{{ route('seguimientos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection