@extends('layouts.app')

@section('title','Editar Integración')

@section('content')

<div class="container mt-4">

    <h3>Editar Registro Financiero</h3>

    <form action="{{ route('finanzas.update', $finanza->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <select name="entidad_id" class="form-control mb-2">
            @foreach($entidades as $entidad)
                <option value="{{ $entidad->id }}"
                    {{ $finanza->entidad_id == $entidad->id ? 'selected' : '' }}>
                    {{ $entidad->nombreEntidad }}
                </option>
            @endforeach
        </select>

        <input type="number"
               step="0.01"
               name="montoPresupuesto"
               class="form-control mb-2"
               value="{{ $finanza->montoPresupuesto }}">

        <input type="text"
               name="estadoTransferencia"
               class="form-control mb-2"
               value="{{ $finanza->estadoTransferencia }}">

        <button class="btn btn-success">
            Actualizar
        </button>

    </form>

</div>

@endsection