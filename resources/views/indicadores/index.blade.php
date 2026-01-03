@extends('layouts.app')

@section('title','Indicadores')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Indicadores</h3>

        <a href="{{ route('indicadores.create') }}" class="btn btn-primary">
            Nuevo Indicador
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
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fórmula</th>
                        <th>Estado</th>
                        <th>Meta</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($indicadores as $indicador)
                    <tr>
                        <td>{{ $indicador->id }}</td>
                        <td>{{ $indicador->codigoIndicador }}</td>
                        <td>{{ $indicador->nombreIndicador }}</td>
                        <td>{{ $indicador->tipoIndicador }}</td>
                        <td>{{ $indicador->formulaIndicador }}</td>
                        <td>{{ $indicador->estadoIndicador }}</td>
                        <td>
                            {{ $indicador->meta->nombreMeta ?? 'Sin Meta' }}
                        </td>
                        <td class="text-center">

                            <a href="{{ route('indicadores.edit', $indicador->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('indicadores.destroy', $indicador->id) }}"
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
                        <td colspan="8" class="text-center">
                            No existen indicadores registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
