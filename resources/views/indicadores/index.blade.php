@extends('layouts.app')

@section('title','Indicadores')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Indicadores de Gestión</h3>

        <a href="{{ route('indicadores.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Indicador
        </a>
    </div>
     
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito optimizado con botón de cierre --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        {{-- Ajuste de p-0 a p-4 para garantizar el correcto flujo de DataTables --}}
        <div class="card-body p-4">

            <div class="table-responsive">
                {{-- Inyección de la clase autoejecutable 'tabla-dinamica' --}}
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Fórmula</th>
                            <th class="text-center">Estado</th>
                            <th>Meta Asociada</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($indicadores as $indicador)
                        <tr>
                            <td>{{ $indicador->id }}</td>
                            <td><span class="badge bg-secondary font-monospace">{{ $indicador->codigoIndicador }}</span></td>
                            <td><strong>{{ $indicador->nombreIndicador }}</strong></td>
                            <td>{{ $indicador->tipoIndicador }}</td>
                            <td>
                                <code class="text-dark bg-light p-1 rounded border fs-7">{{ $indicador->formulaIndicador }}</code>
                            </td>
                            <td class="text-center">
                                @if($indicador->estadoIndicador == 'Activo' || $indicador->estadoIndicador == 'Vigente')
                                    <span class="badge bg-success">{{ $indicador->estadoIndicador }}</span>
                                @elseif($indicador->estadoIndicador == 'Inactivo' || $indicador->estadoIndicador == 'Descontinuado')
                                    <span class="badge bg-danger">{{ $indicador->estadoIndicador }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $indicador->estadoIndicador }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $indicador->meta->nombreMeta ?? 'Sin Meta' }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('indicadores.edit', $indicador->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('indicadores.destroy', $indicador->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este indicador? Esta acción puede alterar los cálculos automáticos del módulo de seguimiento.')">
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