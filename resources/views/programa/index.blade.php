@extends('layouts.app')

@section('title','Programas')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Programas</h3>

        <a href="{{ route('programa.create') }}" class="btn btn-primary">
            Nuevo Programa
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">

            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($programa as $programa)
                    <tr>
                        <td>{{ $programa->id }}</td>
                        <td>{{ $programa->nombrePrograma }}</td>
                        <td>{{ $programa->tipoPrograma }}</td>
                        <td>{{ $programa->descripcionPrograma }}</td>
                        <td>{{ $programa->estadoPrograma }}</td>
                        <td>{{ $programa->responsablePrograma }}</td>
                        <td class="text-center">

                            <a href="{{ route('programa.edit', $programa->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('programa.destroy', $programa->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No existen programas registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
