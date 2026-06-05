@extends('layouts.app')

@section('title','Proyectos')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Proyectos Institucionales</h3>

        <a href="{{ route('proyecto.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Proyecto
        </a>
    </div>

    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito optimizado con botón de cierre --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        
        <div class="card-body p-4">

            <div class="table-responsive">
               
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Programa</th>
                            <th class="text-center">Estado</th>
                            <th>Responsable</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td><strong>{{ $proyecto->nombreProyecto }}</strong></td>
                            <td>
                                {{ $proyecto->programa->nombrePrograma ?? 'Sin programa' }}
                            </td>
                            <td class="text-center">
                                @if($proyecto->estadoProyecto == 'Activo' || $proyecto->estadoProyecto == 'En Ejecución')
                                    <span class="badge bg-success">{{ $proyecto->estadoProyecto }}</span>
                                @elseif($proyecto->estadoProyecto == 'Inactivo' || $proyecto->estadoProyecto == 'Finalizado')
                                    <span class="badge bg-danger">{{ $proyecto->estadoProyecto }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $proyecto->estadoProyecto }}</span>
                                @endif
                            </td>
                            <td>{{ $proyecto->responsableProyecto }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('proyecto.edit', $proyecto->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('proyecto.destroy', $proyecto->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este proyecto? Esta acción desvinculará sus metas físicas e indicadores del presupuesto anual.')">
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