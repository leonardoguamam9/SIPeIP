@extends('layouts.app')

@section('title','Editar Objetivo Estratégico')

@section('content')

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Editar Objetivo Estratégico (OE)</h4>

        <form action="{{ route('oe.update', $oe->id) }}" method="POST">
    @csrf
    @method('PUT')

    @if(request('redirect'))
        <input type="hidden" name="redirect" value="{{ request('redirect') }}">
    @endif


            <div class="mb-3">
                <label class="form-label">Código OE</label>
                <input type="text"
                       name="codigoOE"
                       class="form-control"
                       value="{{ $oe->codigoOE }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del OE</label>
                <input type="text"
                       name="nombreOE"
                       class="form-control"
                       value="{{ $oe->nombreOE }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcionOE"
                          class="form-control"
                          rows="3"
                          required>{{ $oe->descripcionOE }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estadoOE" class="form-control" required>
                    <option value="Borrador" {{ $oe->estadoOE == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="Activo" {{ $oe->estadoOE == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $oe->estadoOE == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Entidad</label>
                <select name="entidad_id" class="form-control" required>
                    @foreach($entidades as $entidad)
                        <option value="{{ $entidad->id }}"
                            {{ $oe->entidad_id == $entidad->id ? 'selected' : '' }}>
                            {{ $entidad->nombreEntidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Plan Nacional de Desarrollo (PDN)</label>
                <select name="pdn_id" class="form-control" required>
                    @foreach($pdns as $pdn)
                        <option value="{{ $pdn->id }}"
                            {{ $oe->pdn_id == $pdn->id ? 'selected' : '' }}>
                            {{ $pdn->nombrePDN }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>

                <a href="{{ route('oe.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
