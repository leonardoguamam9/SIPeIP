@extends('layouts.app')

@section('title','Editar Proyecto')

@section('content')

<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Proyecto Institucional</h4>

        <form action="{{ route('proyecto.update', $proyecto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre del Proyecto</label>
                <input type="text"
                       name="nombreProyecto"
                       class="form-control"
                       value="{{ $proyecto->nombreProyecto }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Proyecto</label>
                <input type="text"
                       name="descripcionProyecto"
                       class="form-control"
                       value="{{ $proyecto->descripcionProyecto }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado del Proyecto</label>
                <select name="estadoProyecto" class="form-control" required>
                    <option value="Borrador" {{ $proyecto->estadoProyecto == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="Activo" {{ $proyecto->estadoProyecto == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Cerrado" {{ $proyecto->estadoProyecto == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Responsable del Proyecto</label>
                <input type="text"
                       name="responsableProyecto"
                       class="form-control"
                       value="{{ $proyecto->responsableProyecto }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Programa</label>
                <select name="programa_id" class="form-control" required>
                    <option value="">Seleccione un programa</option>
                    @foreach($programas as $programa)
                        <option value="{{ $programa->id }}"
                            {{ $programa->id == $proyecto->programa_id ? 'selected' : '' }}>
                            {{ $programa->nombrePrograma }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">Actualizar</button>
                <a href="{{ route('proyecto.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
