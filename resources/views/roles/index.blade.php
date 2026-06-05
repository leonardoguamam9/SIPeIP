@extends('layouts.app')

@section('title','Roles')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Gestión de Roles y Permisos</h3>

        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="bi bi-shield-plus me-1"></i> Nuevo Rol
        </a>
    </div>

    {{-- Sistema de Alertas Institucionales --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        {{-- Ajuste estructural a p-4 para garantizar la inicialización limpia de DataTables --}}
        <div class="card-body p-4">

            <div class="table-responsive">
                {{-- Inyección de la clase autoejecutable 'tabla-dinamica' con alineación vertical regular --}}
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th style="width: 250px;">Nombre del Rol</th>
                            <th>Descripción de Permisos</th>
                            <th class="text-center" style="width: 160px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($roles as $r)
                        <tr>
                            <td class="font-monospace text-secondary">{{ $r->id }}</td>
                            <td>
                                <span class="badge bg-secondary font-monospace text-uppercase p-2">{{ $r->nombre }}</span>
                            </td>
                            <td><strong class="text-secondary">{{ $r->descripcion }}</strong></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('roles.edit', $r) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('roles.destroy', $r) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este rol de acceso? Podría revocar los permisos de los usuarios asignados de forma inmediata.')">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> {{-- Fin contenedor responsivo --}}

        </div>
    </div>

</div>

@endsection