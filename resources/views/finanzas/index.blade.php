@extends('layouts.app')

@section('title','Integración Ministerio de Finanzas')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Integración SIGEF - Ministerio de Finanzas</h3>
        
        
        <button id="exportPdf" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Exportar Historial a PDF
        </button>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Panel Izquierdo: Carga Presupuestaria --}}
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-send-check-fill me-1"></i> Enviar Transferencia Presupuestaria</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('finanzas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Código de Integración (CUR)</label>
                            <input type="text" name="codigoIntegracion" class="form-control font-monospace" placeholder="Ej. CUR-2026-001" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Entidad Pública Operadora</label>
                            <select name="entidad_id" class="form-select" required>
                                <option value="" selected disabled>Seleccione una entidad...</option>
                                @foreach($entidades as $entidad)
                                    <option value="{{ $entidad->id }}">
                                        {{ $entidad->nombreEntidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Monto del Presupuesto Asignado</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0.00" name="montoPresupuesto" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha de Envío Fiscal</label>
                            <input type="date" name="fechaEnvio" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado de Validación</label>
                            <select name="estado" class="form-select" required>
                                <option>Pendiente</option>
                                <option>Enviado</option>
                                <option>Aprobado</option>
                                <option>Rechazado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Justificación / Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3" placeholder="Detalle la partida presupuestaria o decreto regulador..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-cloud-upload me-1"></i> Registrar Transmisión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Panel Derecho: Listado de Auditoría  --}}
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-cash-coin me-1"></i> Historial de Registros Financieros Interconectados</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle tabla-dinamica">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Entidad Pública</th>
                                    <th class="text-end">Monto Asignado</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center" style="width: 140px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($integraciones as $item)
                                <tr>
                                    <td><span class="badge bg-secondary font-monospace">{{ $item->codigoIntegracion }}</span></td>
                                    <td><strong>{{ $item->entidad->nombreEntidad }}</strong></td>
                                    <td class="text-end fw-bold text-success">
                                        ${{ number_format($item->montoPresupuesto, 2, '.', ',') }}
                                    </td>
                                    <td class="text-center">{{ $item->fechaEnvio }}</td>
                                    <td class="text-center">
                                        <span class="badge @if($item->estado == 'Aprobado') bg-success @elseif($item->estado == 'Enviado') bg-primary @elseif($item->estado == 'Pendiente') bg-warning text-dark @else bg-danger @endif">
                                            {{ $item->estado }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            
                                            <a href="{{ route('finanzas.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Editar Parámetros">
                                                Editar
                                            </a>

                                            <form action="{{ route('finanzas.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este registro de consistencia financiera? Podría alterar las validaciones de techos presupuestarios.')">
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
    </div>

</div>

{{-- SCRIPT DE GENERACIÓN DE REPORTES FINANCIEROS  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.getElementById('exportPdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text('Reporte de Consistencia Presupuestaria (SIPeIP - Min. Finanzas)', 10, 15);
    doc.setFontSize(10);
    doc.text('Fecha de Auditoría: ' + new Date().toLocaleDateString(), 10, 22);
    doc.text('Estatus del Sistema: Sincronizado', 10, 27);

    let y = 40;

    {{-- Corrección --}}
    @php
        $datosProcesados = $integraciones->map(function($item) {
            return [
                'codigo' => $item->codigoIntegracion,
                'entidad' => $item->entidad->nombreEntidad ?? 'Sin Entidad',
                'monto' => '$' . number_format($item->montoPresupuesto, 2, '.', ','),
                'fecha' => $item->fechaEnvio,
                'estado' => $item->estado
            ];
        })->toArray();
    @endphp

    {{-- Ahora Blade puede renderizar el JSON de forma segura y sin romper el DOM --}}
    const datosFinanzas = @json($datosProcesados);

    datosFinanzas.forEach(function(item) {
        doc.setFontSize(11);
        doc.setFont("helvetica", "bold");
        doc.text('Código CUR: ' + item.codigo + '  |  Entidad: ' + item.entidad, 10, y);
        y += 6;

        doc.setFont("helvetica", "normal");
        doc.text('Monto Fiscalizado: ' + item.monto + '  |  Fecha Envío: ' + item.fecha + '  |  Estado SIGEF: ' + item.estado, 10, y);
        y += 12;

        if (y > 270) {
            doc.addPage();
            y = 20;
        }
    });

    doc.save('Integracion_Finanzas_SIPeIP.pdf');
});
</script>

@endsection