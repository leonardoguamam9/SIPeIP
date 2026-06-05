@extends('layouts.app')

@section('title', 'Documentos')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Gestión de Documentos de Soporte</h3>
    </div>

  
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Panel Izquierdo: Formulario de Carga de Archivos --}}
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-cloud-arrow-up-fill me-1"></i> Subir Nuevo Documento</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre del Documento</label>
                            <input type="text" name="nombreDocumento" class="form-control" placeholder="Ej. Resolución de Aprobación" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Archivo (PDF, Docx o Imagen)</label>
                            <input type="file" name="archivoDocumento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Módulo del Sistema</label>
                            <select name="modulo" id="moduloSelect" class="form-select" required>
                                <option value="" selected disabled>Seleccione un módulo...</option>
                                <option value="pdn">Plan de Desarrollo Nacional (PDN)</option>
                                <option value="plan">Plan Institucional</option>
                                <option value="proyecto">Proyecto Institucional</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Registro Relacionado</label>
                            <select name="modulo_id" id="moduloIdSelect" class="form-select" required disabled>
                                <option value="">Seleccione un módulo primero</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class="bi bi-file-earmark-arrow-up me-1"></i> Subir Documento
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Panel Derecho: Listado Histórico --}}
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0 fs-6"><i class="bi bi-folder-fill me-1"></i> Repositorio de Documentos Registrados</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        {{-- Inyección de la clase autoejecutable 'tabla-dinamica' --}}
                        <table class="table table-bordered table-striped align-middle tabla-dinamica">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Documento</th>
                                    <th class="text-center">Módulo</th>
                                    <th class="text-center">Archivo</th>
                                    <th class="text-center" style="width: 140px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $doc)
                                <tr>
                                    <td>{{ $doc->id }}</td>
                                    <td><strong>{{ $doc->nombreDocumento }}</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary text-uppercase">{{ $doc->modulo }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/'.$doc->archivoDocumento) }}" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-sm px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Ver Archivo
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{-- Alineación corregida de los botones dentro de la misma celda --}}
                                        <div class="d-flex justify-content-center gap-2">
                                            
                                            <a href="{{ route('documentos.edit', $doc->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                                Editar
                                            </a>

                                            <form action="{{ route('documentos.destroy', $doc->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este documento de soporte de forma permanente?')">
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

@section('scripts')
<script>
    const pdns = @json($pdns ?? []);
    const planes = @json($planes ?? []);
    const proyectos = @json($proyectos ?? []);

    document.getElementById('moduloSelect').addEventListener('change', function () {
        const modulo = this.value;
        const selectId = document.getElementById('moduloIdSelect');
        
        selectId.innerHTML = '<option value="" selected disabled>Seleccione un registro...</option>';
        
        if (modulo) {
            selectId.disabled = false; 
            let opcionesHTML = '';

            if (modulo === 'pdn') {
                pdns.forEach(pdn => {
                    opcionesHTML += `<option value="${pdn.id}">${pdn.nombrePDN}</option>`;
                });
            } else if (modulo === 'plan') {
                planes.forEach(plan => {
                    opcionesHTML += `<option value="${plan.id}">${plan.nombrePlan}</option>`;
                });
            } else if (modulo === 'proyecto') {
                proyectos.forEach(proyecto => {
                    opcionesHTML += `<option value="${proyecto.id}">${proyecto.nombreProyecto}</option>`;
                });
            }
            
            selectId.innerHTML += opcionesHTML;
        } else {
            selectId.innerHTML = '<option value="">Seleccione un módulo primero</option>';
            selectId.disabled = true;
        }
    });
</script>
@endsection