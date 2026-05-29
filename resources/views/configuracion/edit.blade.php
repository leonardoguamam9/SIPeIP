@extends('layouts.app')

@section('title','Editar Configuración')

@section('content')

<div class="container mt-4">

    <h3>Editar Configuración Institucional</h3>
    <hr>

    <form action="{{ route('configuracion.update', $configuracion->id) }}" method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="nombreInstitucion"
               class="form-control mb-2"
               value="{{ $configuracion->nombreInstitucion }}">

        <input type="text"
               name="direccion"
               class="form-control mb-2"
               value="{{ $configuracion->direccion }}">

        <input type="text"
               name="telefono"
               class="form-control mb-2"
               value="{{ $configuracion->telefono }}">

        <input type="email"
               name="correo"
               class="form-control mb-2"
               value="{{ $configuracion->correo }}">

        <input type="text"
               name="periodoFiscal"
               class="form-control mb-2"
               value="{{ $configuracion->periodoFiscal }}">

        <input type="text"
               name="responsable"
               class="form-control mb-2"
               value="{{ $configuracion->responsable }}">

        <button class="btn btn-success">
            Actualizar
        </button>

        <a href="{{ route('configuracion.index') }}"
           class="btn btn-secondary">
           Cancelar
        </a>

    </form>

</div>

@endsection