@extends('layouts.app')

@section('title','Crear PDN')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Plan Nacional de Desarrollo (PDN)</h4>

        <form action="{{ route('pdn.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Código PND</label>
                <input type="text" name="codigoPDN" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del PND</label>
                <input type="text" name="nombrePDN" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionPDN" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoPDN" class="form-control" required>
                <option value="">Seleccione un estado</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
                <option value="Borrador">Borrador</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">Guardar PDN</button>
                <a href="{{ route('pdn.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>

    </div>
</div>

@endsection
