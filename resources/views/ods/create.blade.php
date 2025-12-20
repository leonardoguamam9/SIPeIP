@extends('layouts.app')

@section('title','Crear ODS')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Objetivo de Desarrollo Sostenible (ODS)</h4>

        <form action="{{ route('ods.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del ODS</label>
                <input type="text"
                       name="nombreODS"
                       class="form-control"
                       placeholder="ODS 4 - Educación de Calidad"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de ODS</label>
                <input type="text"
                       name="tipoODS"
                       class="form-control"
                       placeholder="Social / Económico / Ambiental"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del ODS</label>
                <textarea name="descripcionODS"
                          class="form-control"
                          rows="3"
                          placeholder="Descripción general del objetivo"
                          required></textarea>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">
                    Guardar ODS
                </button>

                <a href="{{ route('ods.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection

