@extends('layouts.app')

@section('title','Editar Meta')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">

        <h4 class="text-center mb-4">Editar Meta</h4>

        <form action="{{ route('metas.update', $meta->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if(request()->filled('redirect'))
         <input type="hidden" name="redirect" value="{{ request('redirect') }}">
            @endif


            <div class="mb-3">
                <label class="form-label">Código de Meta</label>
                <input type="text"
                       name="codigoMeta"
                       class="form-control"
                       value="{{ $meta->codigoMeta }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre de la Meta</label>
                <input type="text"
                       name="nombreMeta"
                       class="form-control"
                       value="{{ $meta->nombreMeta }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionMeta"
                          class="form-control"
                          rows="3"
                          required>{{ $meta->descripcionMeta }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoMeta" class="form-control" required>
                    <option value="Borrador" {{ $meta->estadoMeta == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="Activo" {{ $meta->estadoMeta == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $meta->estadoMeta == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('metas.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
