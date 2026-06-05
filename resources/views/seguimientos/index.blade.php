@extends('layouts.app')

@section('title','Seguimiento')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Seguimiento a la Planificación Institucional</h3>
        
        
        <button id="exportPdf" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Exportar a PDF
        </button>
    </div>

    {{-- Alertas del Sistema --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Columna del Formulario de Registro --}}
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 fs-6">Registrar Avance</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('seguimientos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Proyecto</label>
                            <select name="proyecto_id" class="form-select" required>
                                <option value="" disabled selected>Seleccione un proyecto...</option>
                                @foreach($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">
                                        {{ $proyecto->nombreProyecto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Avance (%)</label>
                            <div class="input-group">
                                <input type="number" name="avance" class="form-control" min="0" max="100" placeholder="0" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha de Registro</label>
                            <input type="date" name="fechaSeguimiento" class="form-control" value="{{ date('Y-m-2') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado Actual</label>
                            <select name="estado" class="form-select" required>
                                <option>En Proceso</option>
                                <option>Finalizado</option>
                                <option>Retrasado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Observaciones Técnicas</label>
                            <textarea name="observaciones" class="form-control" rows="3" placeholder="Detalle el estado del proyecto..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-save me-1"></i> Registrar Seguimiento
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0 fs-6">Historial de Registros</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle tabla-dinamica">
                            <thead class="table-dark">
                                <tr>
                                    <th>Proyecto</th>
                                    <th class="text-center">Avance</th>
                                    <th>Fecha</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center" style="width: 140px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seguimientos as $s)
                                <tr>
                                    <td><strong>{{ $s->proyecto->nombreProyecto }}</strong></td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $s->avance }}%</span>
                                        <div class="progress mt-1" style="height: 5px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $s->avance }}%"></div>
                                        </div>
                                    </td>
                                    <td>{{ $s->fechaSeguimiento }}</td>
                                    <td class="text-center">
                                        <span class="badge @if($s->estado == 'Finalizado') bg-success @elseif($s->estado == 'En Proceso') bg-primary @else bg-danger @endif">
                                            {{ $s->estado }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            
                                            <a href="{{ route('seguimientos.edit', $s->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                                Editar
                                            </a>

                                            <form action="{{ route('seguimientos.destroy', $s->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro de seguimiento?')">
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

{{-- Script de exportación a PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.getElementById('exportPdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text('Reporte de Seguimiento a la Planificación (SIPeIP)', 10, 15);
    doc.setFontSize(10);
    doc.text('Fecha de emisión: ' + new Date().toLocaleDateString(), 10, 22);

    let y = 35;

    {{-- Inyección segura por JSON para que strings complejos o comillas no rompan el ciclo JS --}}
    const datosSeguimiento = [
        @foreach($seguimientos as $s)
        {
            proyecto: {!! json_encode($s->proyecto->nombreProyecto ?? 'Sin proyecto') !!},
            avance: "{{ $s->avance }}%",
            fecha: "{{ $s->fechaSeguimiento }}",
            estado: "{{ $s->estado }}"
        },
        @endforeach
    ];

    datosSeguimiento.forEach(function(item) {
        doc.setFontSize(11);
        doc.setFont("helvetica", "bold");
        doc.text('Proyecto: ' + item.proyecto, 10, y);
        y += 6;

        doc.setFont("helvetica", "normal");
        doc.text('Avance: ' + item.avance + '  |  Fecha: ' + item.fecha + '  |  Estado: ' + item.estado, 10, y);
        y += 10;

        if (y > 270) {
            doc.addPage();
            y = 20;
        }
    });

    doc.save('Seguimiento_SIPeIP.pdf');
});
</script>

@endsection