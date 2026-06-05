@extends('layouts.app')

@section('title', 'Editar Documento')

@section('content')


<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">

        <h4 class="text-center mb-4">Editar Documento</h4>

        <form action="{{ route('documentos.update', $documento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text"
                       name="nombreDocumento"
                       class="form-control"
                       value="{{ $documento->nombreDocumento }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Módulo</label>
                <select name="modulo"
                        id="moduloSelect"
                        class="form-control"
                        required>
                    <option value="pdn" {{ $documento->modulo == 'pdn' ? 'selected' : '' }}>PDN</option>
                    <option value="plan" {{ $documento->modulo == 'plan' ? 'selected' : '' }}>Plan</option>
                    <option value="proyecto" {{ $documento->modulo == 'proyecto' ? 'selected' : '' }}>Proyecto</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Registro Relacionado</label>
                <select name="modulo_id"
                        id="moduloIdSelect"
                        class="form-control"
                        required>
                </select>
            </div>

            <div class="d-grid">
                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('documentos.index') }}" class="btn btn-secondary mt-2">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>

@endsection

@section('scripts')
<script>
const pdns = @json($pdns);
const planes = @json($planes);
const proyectos = @json($proyectos);

const documentoModulo = "{{ $documento->modulo }}";
const documentoModuloId = "{{ $documento->modulo_id }}";

function cargarOpciones() {
    let modulo = document.getElementById('moduloSelect').value;
    let select = document.getElementById('moduloIdSelect');

    select.innerHTML = '';
    let datos = [];

    if(modulo === 'pdn') datos = pdns;
    else if(modulo === 'plan') datos = planes;
    else if(modulo === 'proyecto') datos = proyectos;

    datos.forEach(item => {
        let nombre = item.nombrePDN || item.nombrePlan || item.nombreProyecto;

        select.innerHTML += `
            <option value="${item.id}" ${item.id == documentoModuloId ? 'selected' : ''}>
                ${nombre}
            </option>
        `;
    });
}

document.getElementById('moduloSelect').addEventListener('change', cargarOpciones);
window.onload = cargarOpciones;
</script>
@endsection