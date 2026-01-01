@extends('layouts.app')

@section('title','Editar PDN')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Editar Plan Nacional de Desarrollo (PDN)</h4>

        <form action="{{ route('pdn.update', $pdn->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Código PND</label>
                <input type="text" name="codigoPDN" class="form-control"
                       value="{{ $pdn->codigoPDN }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del PND</label>
                <input type="text" name="nombrePDN" class="form-control"
                       value="{{ $pdn->nombrePDN }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionPDN" class="form-control" rows="3" required>{{ $pdn->descripcionPDN }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoPDN" class="form-control" required>
                <option value="Activo" {{ $pdn->estadoPDN == 'Activo' ? 'selected' : '' }}>
                Activo
                </option>
                <option value="Inactivo" {{ $pdn->estadoPDN == 'Inactivo' ? 'selected' : '' }}>
                Inactivo
                </option>
                <option value="Borrador" {{ $pdn->estadoPDN == 'Borrador' ? 'selected' : '' }}>
                Borrador
                </option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('pdn.index') }}" class="btn btn-secondary">Cancelar</a>
            </div

     </form>

    </div>
</div>

@endsection
