@extends('layouts.app')

@section('title','Editar Plan')

@section('content')

{{-- Contenedor flexible para centrar la tarjeta en la pantalla --}}
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Editar Plan Institucional</h4>

        <form action="{{ route('planes.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre del Plan</label>
                <input type="text"
                       name="nombrePlan"
                       class="form-control"
                       value="{{ $plan->nombrePlan }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text"
                       name="descripcionPlan"
                       class="form-control"
                       value="{{ $plan->descripcionPlan }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <input type="text"
                       name="estadoPlan"
                       class="form-control"
                       value="{{ $plan->estadoPlan }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date"
                       name="fechaInicio"
                       class="form-control"
                       value="{{ $plan->fechaInicio }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date"
                       name="fechaFin"
                       class="form-control"
                       value="{{ $plan->fechaFin }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Entidad</label>
                <select name="entidad_id" class="form-control" required>
                    @foreach($entidades as $entidad)
                        <option value="{{ $entidad->id }}"
                            {{ $plan->entidad_id == $entidad->id ? 'selected' : '' }}>
                            {{ $entidad->nombreEntidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid">
                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('planes.index') }}" class="btn btn-secondary mt-2">
                    Cancelar
                </a>
            </div>
        </form>

    </div>

</div>

@endsection