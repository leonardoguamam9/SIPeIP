@extends('layouts.app')

@section('title','Auditoría')

@section('content')

<div class="container mt-4">

    <h3>Registro de Auditoría</h3>

    <hr>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Módulo</th>
                        <th>Descripción</th>
                        <th>IP</th>
                        <th>Fecha</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($auditorias as $auditoria)

                    <tr>

                        <td>{{ $auditoria->id }}</td>

                        <td>
                            {{ $auditoria->user->name ?? 'Sistema' }}
                        </td>

                        <td>{{ $auditoria->accion }}</td>

                        <td>{{ $auditoria->modulo }}</td>

                        <td>{{ $auditoria->descripcion }}</td>

                        <td>{{ $auditoria->ip }}</td>

                        <td>
                            {{ $auditoria->created_at }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection