@extends('layouts.app')

@section('title','Seguimiento')

@section('content')

<div class="container mt-4">

    <h3>Seguimiento a la Planificación</h3>

    <hr>

    <form action="{{ route('seguimientos.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Proyecto</label>
            <select name="proyecto_id" class="form-control">

                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">
                        {{ $proyecto->nombreProyecto }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Avance (%)</label>
            <input type="number"
                   name="avance"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones"
                      class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date"
                   name="fechaSeguimiento"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option>En Proceso</option>
                <option>Finalizado</option>
                <option>Retrasado</option>
            </select>
        </div>

        <button class="btn btn-success">
            Registrar Seguimiento
        </button>

        

    </form>

    <hr>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Avance</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>

            @foreach($seguimientos as $s)
            <tr>
                <td>{{ $s->proyecto->nombreProyecto }}</td>
                <td>{{ $s->avance }}%</td>
                <td>{{ $s->fechaSeguimiento }}</td>
                <td>{{ $s->estado }}</td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <button id="exportPdf" class="btn btn-danger mb-3">
        Exportar Seguimientos a PDF
        </button>



</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>

document.getElementById('exportPdf').addEventListener('click', function () {

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text('Reporte de Seguimiento a la Planificación', 10, 15);

    let y = 30;

    @foreach($seguimientos as $s)

        doc.setFontSize(12);

        doc.text('Proyecto: {{ $s->proyecto->nombreProyecto }}', 10, y);
        y += 8;

        doc.text('Avance: {{ $s->avance }}%', 10, y);
        y += 8;

        doc.text('Fecha: {{ $s->fechaSeguimiento }}', 10, y);
        y += 8;

        doc.text('Estado: {{ $s->estado }}', 10, y);
        y += 12;

        if(y > 270){
            doc.addPage();
            y = 20;
        }

    @endforeach

    doc.save('Seguimiento_SIPeIP.pdf');

});

</script>

@endsection



