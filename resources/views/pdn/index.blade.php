@extends('layouts.app')

@section('title','PDN')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Planes Nacionales de Desarrollo (PDN)</h3>

        <a href="{{ route('pdn.create') }}" class="btn btn-primary">
            Nuevo PDN
        </a>
    </div>

    {{-- Mensaje de éxito --}}
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
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Año inicio</th>
                        <th>Año fin</th>
                        <th>Horizonte</th>
                        <th>Fecha aprobación</th>
                        <th>Resolución</th>
                        <th>Entidad</th>
                        <th>Usuario</th>
                        <th>Responsable PDN</th>
                        <th>Documento</th>
                        <th>Repositorio</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($pdns as $pdn)
                    <tr>
                        <td>{{ $pdn->id }}</td>
                        <td>{{ $pdn->codigoPDN }}</td>
                        <td>{{ $pdn->nombrePDN }}</td>
                        <td>{{ $pdn->descripcionPDN }}</td>
                        <td>{{ $pdn->anio_inicio }}</td>
                        <td>{{ $pdn->anio_fin }}</td>
                        <td>{{ $pdn->horizonte_planificacion }}</td>
                        <td>{{ $pdn->fecha_aprobacion ?? '-' }}</td>
                        <td>{{ $pdn->resolucion_aprobacion ?? '-' }}</td>
                        <td>{{ $pdn->entidad->nombreEntidad ?? 'Sin entidad' }}</td>
                        <td>{{ $pdn->user->name ?? 'Sin usuario' }}</td>
                        <td>{{ $pdn->responsable_pdn ?? '-' }}</td>
                        <td>{{ $pdn->documentoPDN ?? '-' }}</td>
                        <td>{{ $pdn->url_repositorio ?? '-' }}</td>
                        <td>{{ $pdn->observaciones ?? '-' }}</td>

                        <td>
                            @if($pdn->estadoPDN == 'Activo')
                                <span class="badge bg-success">Activo</span>
                            @elseif($pdn->estadoPDN == 'Inactivo')
                                <span class="badge bg-danger">Inactivo</span>
                            @else
                                <span class="badge bg-secondary">Borrador</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('pdn.edit', $pdn->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('pdn.destroy', $pdn->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este PDN?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="text-center">
                            No existen PDN registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
