@extends('layouts.app')

@section('title','Crear Meta')

@section('content')

<div class="container my-5 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4 text-dark">Crear Nueva Meta</h4>

        {{-- Muestra errores de validación si el controlador los detecta --}}
        @if ($errors->any())
            <div class="alert alert-danger p-2 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('metas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                 <label class="form-label fw-bold small text-secondary">Código de la Meta</label>
                 <input type="text"
                        name="codigoMeta"
                        class="form-control @error('codigoMeta') is-invalid @enderror"
                        value="{{ old('codigoMeta') }}"
                        placeholder="Ej: MET-OE1-01"
                        required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-secondary">Nombre de la Meta</label>
                <input type="text"
                       name="nombreMeta"
                       class="form-control @error('nombreMeta') is-invalid @enderror"
                       value="{{ old('nombreMeta') }}"
                       placeholder="Ej: Cobertura de Infraestructura"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-secondary">Descripción de la Meta</label>
                <textarea name="descripcionMeta"
                          class="form-control @error('descripcionMeta') is-invalid @enderror"
                          rows="3"
                          placeholder="Describa el indicador medible de la meta..."
                          required>{{ old('descripcionMeta') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-secondary">Estado</label>
                <select name="estadoMeta" class="form-control" required>
                    <option value="Borrador" {{ old('estadoMeta') == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="Activo" {{ old('estadoMeta') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estadoMeta') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-secondary">Objetivo Estratégico (OE)</label>
                <select name="oe_id" class="form-control @error('oe_id') is-invalid @enderror" required>
                    <option value="">Seleccione un OE</option>
                    @foreach($oes as $oe)
                        <option value="{{ $oe->id }}" {{ old('oe_id') == $oe->id ? 'selected' : '' }}>
                            {{ $oe->codigoOE }} - {{ $oe->nombreOE }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    Guardar Meta
                </button>

                <a href="{{ route('metas.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection