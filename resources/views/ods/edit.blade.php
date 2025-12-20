@extends('layouts.app')

@section('title','Editar ODS')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">
            Editar Objetivo de Desarrollo Sostenible (ODS)
        </h4>

        <form action="{{ route('ods.update', $ods->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre del ODS</label>
                <input type="text"
                       name="nombreODS"
                       class="form-control"
                       value="{{ old('nombreODS', $ods->nombreODS) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de ODS</label>
                <input type="text"
                       name="tipoODS"
                       class="form-control"
                       value="{{ old('tipoODS', $ods->tipoODS) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del ODS</label>
                <textarea name="descripcionODS"
                          class="form-control"
                          rows="3"
                          required>{{ old('descripcionODS', $ods->descripcionODS) }}</textarea>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Actualizar ODS
                </button>

                <a href="{{ route('ods.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
