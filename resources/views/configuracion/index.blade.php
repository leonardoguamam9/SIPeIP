@extends('layouts.app')

@section('title','Configuración Institucional')

@section('content')

<div class="container mt-4">

    <h3>Configuración Institucional</h3>
    <hr>

    <form action="{{ route('configuracion.store') }}" method="POST">
        @csrf

        <input type="text" name="nombreInstitucion" class="form-control mb-2" placeholder="Nombre Institución">

        <input type="text" name="direccion" class="form-control mb-2" placeholder="Dirección">

        <input type="text" name="telefono" class="form-control mb-2" placeholder="Teléfono">

        <input type="email" name="correo" class="form-control mb-2" placeholder="Correo">

        <input type="text" name="periodoFiscal" class="form-control mb-2" placeholder="Periodo Fiscal">

        <input type="text" name="responsable" class="form-control mb-2" placeholder="Responsable">

        <button class="btn btn-success">
            Guardar
        </button>
    </form>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Institución</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Responsable</th>
                <th>Periodo</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            @foreach($configuraciones as $config)
            <tr>
                <td>{{ $config->nombreInstitucion }}</td>
                <td>{{ $config->direccion }}</td>
                <td>{{ $config->telefono }}</td>
                <td>{{ $config->correo }}</td>
                <td>{{ $config->responsable }}</td>
                <td>{{ $config->periodoFiscal }}</td>
                <td>
             <a href="{{ route('configuracion.edit',$config->id) }}"
       class="btn btn-warning btn-sm">
       Editar
    </a>

    <form action="{{ route('configuracion.destroy',$config->id) }}"
          method="POST"
          style="display:inline;">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm">
            Eliminar
        </button>
    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection