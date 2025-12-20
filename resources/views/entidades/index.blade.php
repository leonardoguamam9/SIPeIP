@extends('layouts.app')

@section('title','Entidades')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Entidades Institucionales</h3>

        <a href="{{ route('entidades.create') }}" class="btn btn-primary">
            Nueva Entidad
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
                        <th>Tipo</th>
                        <th>Dirección</th>
                        <th>Subsector</th>
                        <th>Responsable</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($entidades as $entidad)
                    <tr>
                        <td>{{ $entidad->id }}</td>
                        <td>{{ $entidad->nombreEntidad }}</td>
                        <td>{{ $entidad->tipoEntidad }}</td>
                        <td>{{ $entidad->direccionEntidad }}</td>
                        <td>{{ $entidad->subSector }}</td>
                        <td>{{ $entidad->responsable }}</td>
                        <td class="text-center">

                            <a href="{{ route('entidades.edit', $entidad->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('entidades.destroy', $entidad->id) }}"
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
                            No existen entidades registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
