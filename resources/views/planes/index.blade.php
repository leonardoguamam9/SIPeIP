@extends('layouts.app')

@section('title','Planes')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Planes Institucionales</h3>

        <a href="{{ route('planes.create') }}" class="btn btn-primary">
            Nuevo Plan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">

            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Entidad</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($planes as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->nombrePlan }}</td>
                        <td>{{ $plan->entidad->nombreEntidad ??'Sin entidad' }}</td>
                        <td>{{ $plan->estadoPlan }}</td>
                        <td>{{ $plan->fechaInicio }}</td>
                        <td>{{ $plan->fechaFin }}</td>
                        <td class="text-center">

                            <a href="{{ route('planes.edit', $plan->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('planes.destroy', $plan->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar este plan?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No existen planes registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
