@extends('layouts.app')

@section('title','Crear Meta')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Crear Meta</h4>

        <form action="{{ route('metas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                 <label class="form-label">Código de la Meta</label>
                 <input type="text"
                        name="codigoMeta"
                        class="form-control"
                        required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre de la Meta</label>
                <input type="text"
                       name="nombreMeta"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción de la Meta</label>
                <textarea name="descripcionMeta"
                          class="form-control"
                          rows="3"
                          required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoMeta" class="form-control" required>
                    <option value="Borrador">Borrador</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Objetivo Estratégico (OE)</label>
                <select name="oe_id" class="form-control" required>
                    <option value="">Seleccione un OE</option>
                    @foreach($oes as $oe)
                        <option value="{{ $oe->id }}">
                            {{ $oe->codigoOE }} - {{ $oe->nombreOE }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">
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
