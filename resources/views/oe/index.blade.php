@extends('layouts.app')

@section('title','Objetivos Estratégicos')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Objetivos Estratégicos (OE)</h3>

        <a href="{{ route('oe.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo OE
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-center">Estado</th>
                            <th>Entidad</th>
                            <th>PND</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($oes as $oe)
                        <tr>
                            <td>{{ $oe->id }}</td>
                            <td class="fw-bold text-secondary">{{ $oe->codigoOE }}</td>
                            <td><strong>{{ $oe->nombreOE }}</strong></td>
                            <td>{{ $oe->descripcionOE }}</td>
                            <td class="text-center">
                                @if($oe->estadoOE == 'Activo' || $oe->estadoOE == 'Habilitado')
                                    <span class="badge bg-success">{{ $oe->estadoOE }}</span>
                                @elseif($oe->estadoOE == 'Inactivo' || $oe->estadoOE == 'Deshabilitado')
                                    <span class="badge bg-danger">{{ $oe->estadoOE }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $oe->estadoOE }}</span>
                                @endif
                            </td>
                            <td>{{ $oe->entidad->nombreEntidad ?? 'Sin entidad' }}</td>
                            <td>{{ $oe->pdn->nombrePDN ?? 'Sin PND' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('oe.edit', $oe->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('oe.destroy', $oe->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este Objetivo Estratégico? Esta acción podría afectar la vinculación de metas e indicadores institucionales.')">
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