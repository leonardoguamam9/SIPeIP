@extends('layouts.app')

@section('title','Objetivos Estratégicos')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Objetivos Estratégicos (OE)</h3>

        <a href="{{ route('oe.create') }}" class="btn btn-primary">
            Nuevo OE
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
                        <th>Estado</th>
                        <th>Entidad</th>
                        <th>PND</th>
                        

                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($oes as $oe)
                    <tr>
                        <td>{{ $oe->id }}</td>
                        <td>{{ $oe->codigoOE }}</td>
                        <td>{{ $oe->nombreOE }}</td>
                        <td>{{ $oe->descripcionOE }}</td>
                        <td>{{ $oe->estadoOE }}</td>
                        <td>{{ $oe->entidad->nombreEntidad ?? 'Sin entidad' }}</td>
                        <td>{{ $oe->pdn->nombrePDN ?? 'Sin PDN' }}</td>
                        <td class="text-center">

                            <a href="{{ route('oe.edit', $oe->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('oe.destroy', $oe->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar este OE?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No existen Objetivos Estratégicos registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
