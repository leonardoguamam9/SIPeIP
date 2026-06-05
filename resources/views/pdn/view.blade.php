@extends('layouts.app')

@section('title', 'Bandeja del Panel Maestro')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Panel Maestro – Plan Nacional de Desarrollo</h3>

        <a href="{{ route('pdn.master') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nueva Consolidación
        </a>
    </div>

    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito con cierre optimizado --}}
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
                            <th>Entidad / Institución</th>
                            <th>Plan Vinculado</th>
                            <th>Proyecto de Inversión</th>
                            <th>Fecha de Registro</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($reportes ?? [] as $reporte)
                        <tr>
                            <td>{{ $reporte->id }}</td>
                            <td>
                                <strong>{{ $reporte->entidad->nombreEntidad ?? '—' }}</strong>
                                <br>
                                <small class="text-muted">{{ $reporte->entidad->tipoEntidad ?? '—' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark fw-bold mb-1">
                                    {{ $reporte->pdn->codigoPDN ?? 'PDN' }}
                                </span>
                                <div class="small text-truncate" style="max-width: 250px;">
                                    {{ $reporte->plan->nombrePlan ?? '—' }}
                                </div>
                            </td>
                            <td>{{ $reporte->proyecto->nombreProyecto ?? '—' }}</td>
                            <td>{{ $reporte->created_at ? $reporte->created_at->format('d/m/Y H:i') : '—' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pdn.master', ['id' => $reporte->id]) }}"
                                       class="btn btn-info btn-sm fw-bold text-dark">
                                        Detalle
                                    </a>

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