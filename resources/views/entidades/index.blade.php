@extends('layouts.app')

@section('title','Entidades')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Entidades Institucionales</h3>

        <a href="{{ route('entidades.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nueva Entidad
        </a>
    </div>
    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        {{-- Quitamos p-0 para permitir que los controles de DataTables respiren adecuadamente --}}
        <div class="card-body p-4"> 

            {{-- Añadimos la clase 'tabla-dinamica' y un contenedor responsive --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Dirección</th>
                            <th>Subsector</th>
                            <th>Responsable</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($entidades as $entidad)
                        <tr>
                            <td>{{ $entidad->id }}</td>
                            <td><strong>{{ $entidad->nombreEntidad }}</strong></td>
                            <td>{{ $entidad->tipoEntidad }}</td>
                            <td>{{ $entidad->direccionEntidad }}</td>
                            <td>{{ $entidad->subSector }}</td>
                            <td>{{ $entidad->responsable }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    
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
                                                onclick="return confirm('¿Está seguro de eliminar esta entidad institucional? Esta acción podría afectar a los planes vinculados.')">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection