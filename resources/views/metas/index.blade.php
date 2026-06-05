@extends('layouts.app')

@section('title','Metas')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Metas</h3>

        {{-- Botón de creación --}}
        <a href="{{ route('metas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nueva Meta
        </a>
    </div>

   
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    {{-- Mensaje de éxito con botón de cierre --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        {{-- Cambiado p-0 por p-4 para que los componentes dinámicos de DataTables tengan margen técnico --}}
        <div class="card-body p-4">

            <div class="table-responsive">
                {{-- Se inyecta la clase centralizada 'tabla-dinamica' --}}
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($metas as $meta)
                        <tr>
                            <td>{{ $meta->id }}</td>
                            <td class="fw-bold text-secondary">{{ $meta->codigoMeta }}</td>
                            <td><strong>{{ $meta->nombreMeta }}</strong></td>
                            <td>{{ $meta->descripcionMeta }}</td>
                            <td class="text-center">
                                @if($meta->estadoMeta == 'Activo')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($meta->estadoMeta == 'Inactivo')
                                    <span class="badge bg-danger">Inactivo</span>
                                @else
                                    <span class="badge bg-secondary">Borrador</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('metas.edit', $meta->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('metas.destroy', $meta->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar esta meta? Esta acción modificará los indicadores asociados.')">
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