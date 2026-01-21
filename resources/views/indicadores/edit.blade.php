@extends('layouts.app')

@section('title','Editar Indicador')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Indicador</h4>

        <form method="POST" action="{{ route('indicadores.update', $indicador->id) }}">
    @csrf
    @method('PUT')

    <input type="hidden" name="redirect" value="{{ request('redirect') }}">

            <div class="mb-3">
                <label class="form-label">Código del Indicador</label>
                <input type="text"
                       name="codigoIndicador"
                       class="form-control"
                       value="{{ $indicador->codigoIndicador }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del Indicador</label>
                <input type="text"
                       name="nombreIndicador"
                       class="form-control"
                       value="{{ $indicador->nombreIndicador }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionIndicador"
                          class="form-control"
                          rows="3"
                          required>{{ $indicador->descripcionIndicador }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Indicador</label>
                <input type="text"
                       name="tipoIndicador"
                       class="form-control"
                       value="{{ $indicador->tipoIndicador }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fórmula del Indicador</label>
                <input type="text"
                       name="formulaIndicador"
                       class="form-control"
                       value="{{ $indicador->formulaIndicador }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoIndicador" class="form-control" required>
                    <option value="Borrador" {{ $indicador->estadoIndicador == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="Activo" {{ $indicador->estadoIndicador == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $indicador->estadoIndicador == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta</label>
                <select name="meta_id" class="form-control" required>
                    @foreach($metas as $meta)
                        <option value="{{ $meta->id }}"
                            {{ $indicador->meta_id == $meta->id ? 'selected' : '' }}>
                            {{ $meta->codigoMeta }} - {{ $meta->nombreMeta }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('indicadores.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
