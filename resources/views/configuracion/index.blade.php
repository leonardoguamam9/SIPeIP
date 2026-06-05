@extends('layouts.app')

@section('title', 'Configuración Institucional')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Configuración Global del Sistema</h3>
        <span class="badge bg-primary px-3 py-2">Parametrización SIPeIP</span>
    </div>
    
    <hr>

    {{-- Sistema Central de Mensajes y Alertas --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Panel Izquierdo: Formulario de Registro / Modificación --}}
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-sliders me-1"></i> Datos de la Entidad Gubernamental</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('configuracion.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de la Institución</label>
                            <input type="text" name="nombreInstitucion" class="form-control" placeholder="Ej. GAD Municipal de Loja" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Dirección Matriz</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Calle Central y Av. Universitaria" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Teléfono de Contacto</label>
                            <input type="tel" name="telefono" class="form-control" placeholder="Ej. 072570111" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Correo Electrónico Oficial</label>
                            <input type="email" name="correo" class="form-control" placeholder="contacto@institucion.gob.ec" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Periodo Fiscal Activo</label>
                            <input type="number" name="periodoFiscal" class="form-control font-monospace" min="2020" max="2100" value="{{ date('Y') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Máxima Autoridad / Responsable</label>
                            <input type="text" name="responsable" class="form-control" placeholder="Nombre de la autoridad a cargo" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class="bi bi-save2 me-1"></i> Guardar Configuración
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Panel Derecho: Listado Histórico de Entidades y Periodos --}}
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-table me-1"></i> Entidades e Historial Fiscal Registrado</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle tabla-dinamica">
                            <thead class="table-dark">
                                <tr>
                                    <th>Institución</th>
                                    <th>Dirección / Contacto</th>
                                    <th>Correo Electrónico</th>
                                    <th>Responsable Técnico</th>
                                    <th class="text-center" style="width: 90px;">Periodo</th>
                                    <th class="text-center" style="width: 140px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($configuraciones as $config)
                                <tr>
                                    <td>
                                        <span class="fw-bold text-primary">{{ $config->nombreInstitucion }}</span>
                                    </td>
                                    <td>
                                        <small class="d-block text-secondary mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $config->direccion }}</small>
                                        <small class="d-block font-monospace"><i class="bi bi-telephone-fill text-success me-1"></i>{{ $config->telefono }}</small>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $config->correo }}" class="text-decoration-none small">
                                            <i class="bi bi-envelope-at me-1"></i>{{ $config->correo }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-secondary small fw-bold">{{ $config->responsable }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-dark font-monospace px-2 py-2 fs-7">{{ $config->periodoFiscal }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('configuracion.edit', $config->id) }}" class="btn btn-warning btn-sm" title="Editar Configuración">
                                                Editar
                                            </a>

                                            <form action="{{ route('configuracion.destroy', $config->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar esta configuración institucional? Esta acción podría desasociar las variables estructurales del sistema.')">
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

@endsection