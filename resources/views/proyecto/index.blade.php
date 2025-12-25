@extends('layouts.app')

@section('title','Proyectos')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Proyectos Institucionales</h3>

        <a href="{{ route('proyecto.create') }}" class="btn btn-primary">
            Nuevo Proyecto
        </a>
    </div>

    {{-- Mensaje de éxito --}}
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
                        <th>Programa</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->id }}</td>
                        <td>{{ $proyecto->nombreProyecto }}</td>
                        <td>
                            {{ $proyecto->programa->nombrePrograma ?? 'Sin programa' }}
                        </td>
                        <td>{{ $proyecto->estadoProyecto }}</td>
                        <td>{{ $proyecto->responsableProyecto }}</td>
                        <td class="text-center">

                            <a href="{{ route('proyecto.edit', $proyecto->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('proyecto.destroy', $proyecto->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar este proyecto?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No existen proyectos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
