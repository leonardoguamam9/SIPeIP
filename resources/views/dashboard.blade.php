@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-2">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Panel de Control de la Planificación</h2>
            <p class="text-muted small mb-0">Resumen e indicadores estadísticos globales de SIPeIP</p>
        </div>
        <span class="badge bg-primary px-3 py-2 fs-6 shadow-sm">
            Rol: {{ auth()->user()->role_id == 1 ? 'Administrador' : 'Técnico' }}
        </span>
    </div>

  
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 border-start border-primary border-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Proyectos</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalProyectos }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                        <i class="bi bi-folder fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 border-start border-success border-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Planes</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalPlanes }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success">
                        <i class="bi bi-journal-text fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 border-start border-warning border-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Metas Asignadas</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalMetas }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                        <i class="bi bi-flag fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 border-start border-info border-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Indicadores</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalIndicadores }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-3 text-info">
                        <i class="bi bi-graph-up-arrow fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Segundas tarjetas analíticas de control e inversión --}}
<div class="row g-3 mb-4">
    
    {{-- Tarjeta 5: Techo Presupuestario Sincronizado --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0 border-start border-danger border-4 h-100 bg-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Monto Fiscalizado</h6>
                    
                    <h3 class="fw-bold mb-0 text-dark">${{ number_format($totalPresupuesto ?? 0, 2, '.', ',') }}</h3>
                </div>
                <div class="bg-danger bg-opacity-10 p-3 rounded-3 text-danger">
                    <i class="bi bi-bank fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tarjeta 6: Objetivos de Desarrollo Sostenible (ODS) Vinculados --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0 border-start border-dark border-4 h-100 bg-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Impacto ODS</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalOds ?? 0 }} <span class="fs-6 text-muted fw-normal">ODS</span></h3>
                </div>
                <div class="bg-dark bg-opacity-10 p-3 rounded-3 text-dark">
                    <i class="bi bi-globe-americas fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tarjeta 7: Evidencias y Documentos de Respaldo --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0 border-start border-secondary border-4 h-100 bg-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Documentos Cargados</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalDocumentos ?? 0 }}</h3>
                </div>
                <div class="bg-secondary bg-opacity-10 p-3 rounded-3 text-secondary">
                    <i class="bi bi-file-earmark-zip fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tarjeta : Alertas de Seguridad / Entidades Activas --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0 border-start border-indigo border-4 h-100 bg-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Logs de Auditoría</h6>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalAuditorias ?? 0 }}</h3>
                </div>
                {{-- Nota: Si tu tema no incluye la clase utilitaria de color 'indigo' nativa en CSS, puedes usar 'primary' o inyectar estilo de color inline --}}
                <div class="p-3 rounded-3 text-white" style="background-color: rgba(99, 102, 241, 0.1); color: rgb(99, 102, 241) !important;">
                    <i class="bi bi-shield-check-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>

</div>

    {{-- SECCIÓN DE GRÁFICOS ESTADÍSTICOS --}}
    <div class="row g-4">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-1">Estados de Proyectos</h5>
                    <p class="text-muted small mb-0">Distribución porcentual del estado actual</p>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center p-4">
                    <div style="position: relative; width: 100%; max-width: 280px;">
                        <canvas id="chartEstados"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm border-0 h-100 bg-white">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-1">Monitoreo de Avances</h5>
                    <p class="text-muted small mb-0">% de ejecución física en los últimos seguimientos</p>
                </div>
                <div class="card-body p-4">
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="chartAvances"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
{{-- Librería de Chart.js mediante CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- Diagrama circular---
        const ctxEstados = document.getElementById('chartEstados').getContext('2d');
        new Chart(ctxEstados, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($estadosLabels) !!},
                datasets: [{
                    data: {!! json_encode($estadosValores) !!},
                    backgroundColor: ['#3b82f6', '#b91010', '#f59e0b', '#ef4444', '#6366f1'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, padding: 15 }
                    }
                }
            }
        });

        // --- 2. Grafico de barras ---
        const ctxAvances = document.getElementById('chartAvances').getContext('2d');
        new Chart(ctxAvances, {
            type: 'bar',
            data: {
                labels: {!! json_encode($seguimientosLabels) !!},
                datasets: [{
                    label: 'Porcentaje de Avance (%)',
                    data: {!! json_encode($seguimientosAvances) !!},
                    backgroundColor: 'rgba(165, 74, 0, 0.85)', // color del grafico de barras.
                    borderRadius: 6,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: { callback: function(value) { return value + '%'; } }
                    },
                    x: {
                        ticks: {
                            callback: function(value) {
                                let characterLimit = 15;
                                let label = this.getLabelForValue(value);
                                if (label.length > characterLimit) {
                                    return label.substring(0, characterLimit) + '...';
                                }
                                return label;
                            }
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

    });
</script>
@endsection