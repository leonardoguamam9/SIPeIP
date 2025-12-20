@extends('layouts.app')

@section('title','ODS')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Objetivos de Desarrollo Sostenible (ODS)</h3>

        <a href="{{ route('ods.create') }}" class="btn btn-primary">
            Nuevo ODS
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
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($ods as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->nombreODS }}</td>
                        <td>{{ $o->tipoODS }}</td>
                        <td>{{ $o->descripcionODS }}</td>
                        <td class="text-center">

                            <a href="{{ route('ods.edit', $o->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('ods.destroy', $o->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar este ODS?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No existen ODS registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
