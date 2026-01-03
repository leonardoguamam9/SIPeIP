@extends('layouts.app')

@section('title','Metas')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Metas</h3>

        <a href="{{ route('metas.create') }}" class="btn btn-primary">
            Nueva Meta
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
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($metas as $meta)
                    <tr>
                        <td>{{ $meta->id }}</td>
                        <td>{{ $meta->codigoMeta }}</td>
                        <td>{{ $meta->nombreMeta }}</td>
                        <td>{{ $meta->descripcionMeta }}</td>
                        <td>{{ $meta->estadoMeta }}</td>
                        <td class="text-center">

                            <a href="{{ route('metas.edit', $meta->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('metas.destroy', $meta->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar esta meta?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No existen metas registradas
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
