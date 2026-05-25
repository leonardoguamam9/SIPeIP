@extends('layouts.app')

@section('title','Documentos')

@section('content')

<div class="container mt-4">

    <h3>Gestión de Documentos</h3>
    <hr>

    {{-- MENSAJE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="card shadow mb-4">

        <div class="card-body">

            <form action="{{ route('documentos.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- NOMBRE --}}
                <div class="mb-3">
                    <label>Nombre del Documento</label>
                    <input type="text"
                           name="nombreDocumento"
                           class="form-control">
                </div>

                {{-- ARCHIVO --}}
                <div class="mb-3">
                    <label>Archivo</label>
                    <input type="file"
                           name="archivoDocumento"
                           class="form-control">
                </div>

                {{-- MODULO --}}
                <div class="mb-3">
                    <label>Módulo</label>

                    <select name="modulo"
                            id="moduloSelect"
                            class="form-control">

                        <option value="">Seleccione</option>
                        <option value="pdn">PDN</option>
                        <option value="plan">Plan</option>
                        <option value="proyecto">Proyecto</option>

                    </select>
                </div>

                {{-- REGISTRO RELACIONADO --}}
                <div class="mb-3">
                    <label>Registro Relacionado</label>

                    <select name="modulo_id"
                            id="moduloIdSelect"
                            class="form-control">

                        <option value="">
                            Seleccione un módulo primero
                        </option>

                    </select>
                </div>

                <button class="btn btn-success">
                    Subir Documento
                </button>

            </form>

        </div>

    </div>

    {{-- TABLA --}}
    <div class="card shadow">

        <div class="card-body">

            <h5>Documentos Registrados</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Módulo</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($documentos as $doc)

                    <tr>

                        <td>{{ $doc->id }}</td>

                        <td>{{ $doc->nombreDocumento }}</td>

                        <td>{{ $doc->modulo }}</td>

                        <td>
                            <a href="{{ asset('storage/'.$doc->archivoDocumento) }}"
                               target="_blank"
                               class="btn btn-primary btn-sm">
                                Ver Documento
                            </a>
                        </td>

                        <td>

                        <a href="{{ route('documentos.edit', $doc->id) }}"
                        class="btn btn-warning btn-sm">Editar</a>

                        <td>

                            <form action="{{ route('documentos.destroy', $doc->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar documento?')">

                                    Eliminar

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script>

const pdns = @json($pdns);
const planes = @json($planes);
const proyectos = @json($proyectos);

document.getElementById('moduloSelect')
.addEventListener('change', function () {

    let modulo = this.value;
    let select = document.getElementById('moduloIdSelect');

    select.innerHTML = '';

    if(modulo === 'pdn'){

        pdns.forEach(pdn => {
            select.innerHTML += `
                <option value="${pdn.id}">
                    ${pdn.nombrePDN}
                </option>
            `;
        });

    }

    else if(modulo === 'plan'){

        planes.forEach(plan => {
            select.innerHTML += `
                <option value="${plan.id}">
                    ${plan.nombrePlan}
                </option>
            `;
        });

    }

    else if(modulo === 'proyecto'){

        proyectos.forEach(proyecto => {
            select.innerHTML += `
                <option value="${proyecto.id}">
                    ${proyecto.nombreProyecto}
                </option>
            `;
        });

    }

});

</script>

@endsection