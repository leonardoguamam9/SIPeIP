@extends('layouts.app')

@section('title','Crear Objetivo Estratégico')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Crear Objetivo Estratégico (OE)</h4>

        <form action="{{ route('oe.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Código OE</label>
                <input type="text"
                       name="codigoOE"
                       class="form-control"
                       placeholder="OE-01"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del OE</label>
                <input type="text"
                       name="nombreOE"
                       class="form-control"
                       placeholder="Mejorar la gestión institucional"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionOE"
                          class="form-control"
                          rows="3"
                          placeholder="Descripción del objetivo estratégico"
                          required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoOE" class="form-control" required>
                    <option value="Borrador">Borrador</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Entidad</label>
                <select name="entidad_id" class="form-control" required>
                    <option value="">Seleccione una entidad</option>
                    @foreach($entidades as $entidad)
                        <option value="{{ $entidad->id }}">
                            {{ $entidad->nombreEntidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">PDN</label>
                <select name="pdn_id" class="form-control" required>
                    <option value="">Seleccione un PDN</option>
                    @foreach($pdns as $pdn)
                        <option value="{{ $pdn->id }}">
                            {{ $pdn->nombrePDN }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-success">
                    Guardar OE
                </button>

                <a href="{{ route('oe.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
