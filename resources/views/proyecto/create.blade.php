@extends('layouts.app')

@section('title','Crear Proyecto')

@section('content')

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
            <input type="text" name="descripcionProyecto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado del Proyecto</label>
            <input type="text" name="estadoProyecto" class="form-control" value="Borrador" required>
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

        <div class="d-grid">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>

</div>

@endsection


