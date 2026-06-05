@extends('layouts.app')

@section('title','ODS')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Objetivos de Desarrollo Sostenible (ODS)</h3>

        <a href="{{ route('ods.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo ODS
        </a>
    </div>

    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        {{-- Ajustado de p-0 a p-4 para una correcta visualización de DataTables --}}
        <div class="card-body p-4">

            <div class="table-responsive">
                
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($ods as $o)
                        <tr>
                            <td>{{ $o->id }}</td>
                            <td><strong>{{ $o->nombreODS }}</strong></td>
                            <td>{{ $o->tipoODS }}</td>
                            <td>{{ $o->descripcionODS }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('ods.edit', $o->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('ods.destroy', $o->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este ODS? Esta acción podría desvincular planes estratégicos de la institución.')">
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