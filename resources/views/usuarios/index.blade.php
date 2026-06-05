@extends('layouts.app')

@section('title','Usuarios')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Gestión de Usuarios</h3>

        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
        </a>
    </div>

    {{-- Mensajes de Notificación con botón de cierre integrado --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        
        <div class="card-body p-4">

            <div class="table-responsive">
                {{-- Inyección de la clase autoejecutable 'tabla-dinamica' --}}
                <table class="table table-bordered table-striped align-middle tabla-dinamica">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($usuarios as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td><strong>{{ $u->name }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td>
                                {{-- Renderizado condicional del rol con un estilo sutil --}}
                                @if($u->role && $u->role->nombre == 'Administrador')
                                    <span class="badge bg-dark text-light"><i class="bi bi-shield-lock-fill me-1"></i>{{ $u->role->nombre }}</span>
                                @else
                                    <span class="badge bg-light text-dark border"><i class="bi bi-person-fill me-1"></i>{{ $u->role->nombre ?? 'Sin rol' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('usuarios.edit', $u->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $u->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este usuario? Se perderá su vinculación con los registros de auditoría y planificación creados.')">
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