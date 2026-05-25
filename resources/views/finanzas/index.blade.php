@extends('layouts.app')

@section('title','Integración Ministerio de Finanzas')

@section('content')

<div class="container mt-4">

    <h3>Integración con Ministerio de Finanzas</h3>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('finanzas.store') }}" method="POST">
                @csrf

                <input type="text"
                       name="codigoIntegracion"
                       class="form-control mb-2"
                       placeholder="Código Integración">

                <select name="entidad_id" class="form-control mb-2">
                    <option value="">Seleccione una entidad</option>

                    @foreach($entidades as $entidad)
                        <option value="{{ $entidad->id }}">
                            {{ $entidad->nombreEntidad }}
                        </option>
                    @endforeach
                </select>

                <input type="number"
                       step="0.01"
                       name="montoPresupuesto"
                       class="form-control mb-2"
                       placeholder="Monto Presupuesto">

                <input type="date"
                       name="fechaEnvio"
                       class="form-control mb-2">

                <select name="estado" class="form-control mb-2">
                    <option>Pendiente</option>
                    <option>Enviado</option>
                    <option>Aprobado</option>
                    <option>Rechazado</option>
                </select>

                <textarea name="observaciones"
                          class="form-control mb-2"
                          placeholder="Observaciones"></textarea>

                <button class="btn btn-success">
                    Guardar
                </button>

            </form>

        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow">
        <div class="card-body">

            <h5>Registros Financieros</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Entidad</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($integraciones as $item)

                    <tr>
                        <td>{{ $item->codigoIntegracion }}</td>
                        <td>{{ $item->entidad->nombreEntidad }}</td>
                        <td>{{ $item->montoPresupuesto }}</td>
                        <td>{{ $item->fechaEnvio }}</td>
                        <td>{{ $item->estado }}</td>

                        <td>

                            <a href="{{ route('finanzas.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('finanzas.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar registro?')">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

            <button id="exportPdf" class="btn btn-danger mt-3">
                Exportar PDF
            </button>

        </div>
    </div>

</div>

{{-- LIBRERÍA PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>

document.getElementById('exportPdf').addEventListener('click', function () {

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text('Reporte Ministerio de Finanzas - SIPeIP', 10, 15);

    let y = 30;

    @foreach($integraciones as $item)

        doc.setFontSize(12);

        doc.text('Código: {{ $item->codigoIntegracion }}', 10, y);
        y += 8;

        doc.text('Entidad: {{ $item->entidad->nombreEntidad }}', 10, y);
        y += 8;

        doc.text('Monto: {{ $item->montoPresupuesto }}', 10, y);
        y += 8;

        doc.text('Fecha: {{ $item->fechaEnvio }}', 10, y);
        y += 8;

        doc.text('Estado: {{ $item->estado }}', 10, y);
        y += 12;

        if(y > 270){
            doc.addPage();
            y = 20;
        }

    @endforeach

    doc.save('Integracion_Finanzas_SIPeIP.pdf');

});

</script>

@endsection