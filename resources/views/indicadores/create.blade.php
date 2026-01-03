@extends('layouts.app')

@section('title','Crear Indicador')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Indicador</h4>

        <form action="{{ route('indicadores.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Código del Indicador</label>
                <input type="text" name="codigoIndicador" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del Indicador</label>
                <input type="text" name="nombreIndicador" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del Indicador</label>
                <textarea name="descripcionIndicador"
                          class="form-control"
                          rows="3"
                          required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Indicador</label>
                <input type="text" name="tipoIndicador" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fórmula del Indicador</label>
                <input type="text" name="formulaIndicador" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoIndicador" class="form-control" required>
                    <option value="Borrador">Borrador</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta</label>
                <select name="meta_id" class="form-control" required>
                    <option value="">Seleccione una Meta</option>
                    @foreach($metas as $meta)
                        <option value="{{ $meta->id }}">
                            {{ $meta->codigoMeta }} - {{ $meta->nombreMeta }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">Guardar Indicador</button>
                <a href="{{ route('indicadores.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
