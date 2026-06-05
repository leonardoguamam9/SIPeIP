@extends('layouts.app')

@section('title','Programas')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Programas</h3>

        <a href="{{ route('programa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Programa
        </a>
    </div>

    
    <button onclick="window.print()" class="btn btn-danger shadow-sm fw-bold no-print">
        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF / Imprimir
    </button>
</div>

<hr class="no-print">

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        
        <div class="card-body p-4">

            <div class="table-responsive">
                
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th class="text-center">Estado</th>
                            <th>Responsable</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($programa as $prog)
                        <tr>
                            <td>{{ $prog->id }}</td>
                            <td><strong>{{ $prog->nombrePrograma }}</strong></td>
                            <td>{{ $prog->tipoPrograma }}</td>
                            <td>{{ $prog->descripcionPrograma }}</td>
                            <td class="text-center">
                                @if($prog->estadoPrograma == 'Activo' || $prog->estadoPrograma == 'Ejecución')
                                    <span class="badge bg-success">{{ $prog->estadoPrograma }}</span>
                                @elseif($prog->estadoPrograma == 'Inactivo' || $prog->estadoPrograma == 'Suspendido')
                                    <span class="badge bg-danger">{{ $prog->estadoPrograma }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $prog->estadoPrograma }}</span>
                                @endif
                            </td>
                            <td>{{ $prog->responsablePrograma }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('programa.edit', $prog->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('programa.destroy', $prog->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este programa? Esta acción removerá su vinculación de los proyectos y la asignación presupuestaria asociada.')">
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