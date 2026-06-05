@extends('layouts.app')

@section('title','PDN')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Planes Nacionales de Desarrollo (PDN)</h3>

        <a href="{{ route('pdn.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo PDN
        </a>
    </div>

    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito con botón de cierre integrado --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        
        <div class="card-body p-4">

        
            <div class="table-responsive">
               
                <table class="table table-bordered table-striped align-middle tabla-dinamica" style="white-space: nowrap;">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-center">Año inicio</th>
                            <th class="text-center">Año fin</th>
                            <th>Horizonte</th>
                            <th>Fecha aprobación</th>
                            <th>Resolución</th>
                            <th>Entidad</th>
                            <th>Usuario</th>
                            <th>Responsable PDN</th>
                            <th>Documento</th>
                            <th>Repositorio</th>
                            <th>Observaciones</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($pdns as $pdn)
                        <tr>
                            <td>{{ $pdn->id }}</td>
                            <td class="fw-bold text-secondary">{{ $pdn->codigoPDN }}</td>
                            <td><strong>{{ $pdn->nombrePDN }}</strong></td>
                            <td>{{ $pdn->descripcionPDN }}</td>
                            <td class="text-center">{{ $pdn->anio_inicio }}</td>
                            <td class="text-center">{{ $pdn->anio_fin }}</td>
                            <td>{{ $pdn->horizonte_planificacion }}</td>
                            <td>{{ $pdn->fecha_aprobacion ?? '-' }}</td>
                            <td>{{ $pdn->resolucion_aprobacion ?? '-' }}</td>
                            <td>{{ $pdn->entidad->nombreEntidad ?? 'Sin entidad' }}</td>
                            <td>{{ $pdn->user->name ?? 'Sin usuario' }}</td>
                            <td>{{ $pdn->responsable_pdn ?? '-' }}</td>
                            <td>{{ $pdn->documentoPDN ?? '-' }}</td>
                            <td>
                                @if($pdn->url_repositorio)
                                    <a href="{{ $pdn->url_repositorio }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                        <i class="bi bi-link-45deg"></i> Link Repositorio
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $pdn->observaciones ?? '-' }}</td>

                            <td class="text-center">
                                @if($pdn->estadoPDN == 'Activo')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($pdn->estadoPDN == 'Inactivo')
                                    <span class="badge bg-danger">Inactivo</span>
                                @else
                                    <span class="badge bg-secondary">Borrador</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    
                                    <a href="{{ route('pdn.edit', $pdn->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('pdn.destroy', $pdn->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este Plan Nacional de Desarrollo? Esta acción afectará de forma directa a los objetivos estratégicos acoplados.')">
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