@extends('layouts.app')

@section('title', 'Auditoría')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Auditoría e Historial de Eventos</h3>
        <span class="badge bg-dark px-3 py-2">Módulo de Seguridad (SIPeIP)</span>
    </div>
    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">
    
    <hr>

    <div class="card shadow">
        {{-- Ajuste a p-4 para que el buscador y el paginador de DataTables no queden colapsados --}}
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th>Usuario</th>
                            <th class="text-center" style="width: 120px;">Acción</th>
                            <th>Módulo afectado</th>
                            <th>Descripción del Cambio</th>
                            <th class="text-center" style="width: 130px;">Dirección IP</th>
                            <th class="text-center" style="width: 160px;">Fecha y Hora</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($auditorias as $auditoria)
                        <tr>
                            <td class="font-monospace text-secondary">{{ $auditoria->id }}</td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-badge-fill text-secondary me-2"></i>
                                    <div>
                                        <strong>{{ $auditoria->user->name ?? 'Sistema / Cron' }}</strong>
                                        @if($auditoria->user)
                                            <small class="text-muted d-block fs-7">{{ $auditoria->user->email }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                @switch(strtolower($auditoria->accion))
                                    @case('create')
                                    @case('crear')
                                    @case('insert')
                                        <span class="badge bg-success w-100"><i class="bi bi-plus-circle me-1"></i> CREAR</span>
                                        @break
                                    @case('update')
                                    @case('actualizar')
                                    @case('edit')
                                        <span class="badge bg-warning text-dark w-100"><i class="bi bi-pencil-square me-1"></i> MODIFICAR</span>
                                        @break
                                    @case('delete')
                                    @case('eliminar')
                                    @case('destroy')
                                        <span class="badge bg-danger w-100"><i class="bi bi-trash-fill me-1"></i> ELIMINAR</span>
                                        @break
                                    @case('login')
                                        <span class="badge bg-info text-dark w-100"><i class="bi bi-box-arrow-in-right me-1"></i> INGRESO</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary w-100">{{ strtoupper($auditoria->accion) }}</span>
                                @endswitch
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border text-uppercase font-monospace">{{ $auditoria->modulo }}</span>
                            </td>

                            <td>
                                <span class="text-wrap d-block text-secondary fs-7" style="max-width: 300px;">
                                    {{ $auditoria->descripcion }}
                                </span>
                            </td>

                            <td class="text-center font-monospace">
                                <i class="bi bi-shield-fill-check text-success me-1"></i>{{ $auditoria->ip ?? '0.0.0.0' }}
                            </td>

                            <td class="text-center small">
                                @if($auditoria->created_at)
                                    <span class="d-block fw-bold">{{ $auditoria->created_at->format('Y-m-d') }}</span>
                                    <span class="text-muted fs-7">{{ $auditoria->created_at->format('H:i:s') }}</span>
                                @else
                                    <span class="text-muted">No registrada</span>
                                @endif
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