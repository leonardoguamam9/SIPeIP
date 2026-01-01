@extends('layouts.app')

@section('title','PDN')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Planes Nacionales de Desarrollo (PDN)</h3>

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
                        <td>{{ $pdn->estadoPDN }}</td>
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
                        <td colspan="5" class="text-center">
                            No existen PND registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection


