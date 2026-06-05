@extends('layouts.app')

@section('title','Planes')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Planes Institucionales</h3>

        <a href="{{ route('planes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Plan
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
        
        <div class="card-body p-4">

            <div class="table-responsive">
                
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Entidad</th>
                            <th class="text-center">Estado</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($planes as $plan)
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td><strong>{{ $plan->nombrePlan }}</strong></td>
                            <td>{{ $plan->entidad->nombreEntidad ?? 'Sin entidad' }}</td>
                            <td class="text-center">
                                @if($plan->estadoPlan == 'Activo' || $plan->estadoPlan == 'Vigente')
                                    <span class="badge bg-success">{{ $plan->estadoPlan }}</span>
                                @elseif($plan->estadoPlan == 'Inactivo' || $plan->estadoPlan == 'Caducado')
                                    <span class="badge bg-danger">{{ $plan->estadoPlan }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $plan->estadoPlan }}</span>
                                @endif
                            </td>
                            <td>{{ $plan->fechaInicio }}</td>
                            <td>{{ $plan->fechaFin }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('planes.edit', $plan->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('planes.destroy', $plan->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este plan institucional? Esta acción podría afectar en cascada a los objetivos estratégicos, metas y seguimientos enlazados.')">
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