@extends('layouts.app')

@section('title','PDN Maestro')

@section('content')

<div class="container-fluid mt-4">

    <h3 class="mb-4">Panel Maestro – Plan Nacional de Desarrollo (PDN)</h3>
    <hr>

    <h5>Seleccionar Entidad</h5>

    <div class="mb-3">
        <select id="selectEntidad" class="form-control">
            <option value="">-- Seleccione una Entidad --</option>
        </select>
    </div>

    <div id="entidadInfo" class="alert alert-info d-none"></div>

</div>

<hr>

<h5>Seleccionar Plan Nacional de Desarrollo (PDN)</h5>

<div class="mb-3">
    <select id="selectPdn" class="form-control">
        <option value="">-- Seleccione un PDN --</option>
    </select>
</div>

<div id="pdnInfo" class="alert alert-warning d-none"></div>
 
<hr>

<h5>Objetivos Estratégicos (OE)</h5>

<div id="oesList" class="alert alert-secondary">
    Seleccione un PDN para ver sus OE
</div>

<h5>Seleccionar ODS</h5>
<div class="mb-3">
    <select id="selectOds" class="form-control">
        <option value="">-- Seleccione un ODS --</option>
    </select>
</div>

<div id="odsInfo" class="alert alert-info d-none"></div>

<h5>Seleccionar Plan Institucional</h5>
<div class="mb-3">
    <select id="selectPlan" class="form-control">
        <option value="">-- Seleccione un Plan --</option>
    </select>
</div>

<div id="planInfo" class="alert alert-info d-none"></div>

<h5>Seleccionar Meta</h5>
<div class="mb-3">
    <select id="selectMeta" class="form-control">
        <option value="">-- Seleccione una Meta --</option>
    </select>
</div>

<div id="metaInfo" class="alert alert-info d-none"></div>

<h5>Seleccionar Programa</h5>
<div class="mb-3">
    <select id="selectPrograma" class="form-control">
        <option value="">-- Seleccione un Programa --</option>
    </select>
</div>

<div id="programaInfo" class="alert alert-info d-none"></div>

<h5>Seleccionar Proyecto</h5>
<div class="mb-3">
    <select id="selectProyecto" class="form-control">
        <option value="">-- Seleccione un Proyecto --</option>
    </select>
</div>

<div id="proyectoInfo" class="alert alert-info d-none"></div>

<div class="d-grid mt-4">
    <button id="exportPdf" class="btn btn-success">Exportar todo a PDF</button>
</div>


@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
$(document).ready(function () {

    $.get('/entidades/list', function (data) {
        data.forEach(entidad => {
            $('#selectEntidad').append(
                `<option value="${entidad.id}">
                    ${entidad.nombreEntidad}
                </option>`
            );
        });
    });

    $('#selectEntidad').change(function () {

        let entidadId = $(this).val();

        if (!entidadId) {
            $('#entidadInfo').addClass('d-none');
            return;
        }

        $.get('/entidades/' + entidadId, function (entidad) {

            $('#entidadInfo')
                .removeClass('d-none')
                .html(`
                    <strong>Entidad seleccionada</strong><br>
                    <b>Nombre:</b> ${entidad.nombreEntidad}<br>
                    <b>Tipo:</b> ${entidad.tipoEntidad}<br>
                    <b>Dirección:</b> ${entidad.direccionEntidad}<br>
                    <b>Subsector:</b> ${entidad.subSector}<br>
                    <b>Responsable:</b> ${entidad.responsable}
                `);
        });
    });

});

// Cargar PDN
$.get('/pdns/list', function (data) {
    data.forEach(pdn => {
        $('#selectPdn').append(
            `<option value="${pdn.id}">
                ${pdn.codigoPDN} - ${pdn.nombrePDN}
            </option>`
        );
    });
});
$('#selectPdn').change(function () {

    let pdnId = $(this).val();

    if (!pdnId) {
        $('#pdnInfo').addClass('d-none');
        return;
    }

    $.get('/pdns/' + pdnId, function (pdn) {

        $('#pdnInfo')
            .removeClass('d-none')
            .html(`
                <strong>PDN seleccionado</strong><br><br>

                <b>Código:</b> ${pdn.codigoPDN}<br>
                <b>Nombre:</b> ${pdn.nombrePDN}<br>
                <b>Estado:</b> ${pdn.estadoPDN}<br>
                <b>Descripción:</b> ${pdn.descripcionPDN ?? '—'}<br><hr>

                <b>Año inicio:</b> ${pdn.anio_inicio ?? '—'}<br>
                <b>Año fin:</b> ${pdn.anio_fin ?? '—'}<br>
                <b>Horizonte:</b> ${pdn.horizonte_planificacion ?? '—'}<br><hr>

                <b>Fecha aprobación:</b> ${pdn.fecha_aprobacion ?? '—'}<br>
                <b>Resolución:</b> ${pdn.resolucion_aprobacion ?? '—'}<br>
                <b>Responsable:</b> ${pdn.responsable_pdn ?? '—'}<br><hr>

                <b>Documento:</b> ${pdn.documentoPDN ?? '—'}<br>
                <b>Repositorio:</b>
                ${pdn.url_repositorio 
                    ? `<a href="${pdn.url_repositorio}" target="_blank">Ver repositorio</a>` 
                    : '—'}<br><hr>

                <b>Observaciones:</b><br>
                ${pdn.observaciones ?? '—'}
            `);
    });
    


      $.get('/pdns/' + pdnId + '/oes', function (oes) {

        if (!oes || oes.length === 0) {
            $('#oesList').html('<p class="text-muted">Este PDN no tiene Objetivos Estratégicos.</p>');
            return;
        }

        let html = '<ul class="list-group">';
        oes.forEach(oe => {
            html += `
                <li class="list-group-item">
                    <strong>${oe.codigoOE ?? ''}</strong> ${oe.nombreOE}
                </li>`;
        });
        html += '</ul>';

        $('#oesList').html(html);
    });
});


$(document).ready(function () {
    // Cargar todos los ODS en el select
$.get('/ods/list', function (ods) {
    ods.forEach(od => {
        $('#selectOds').append(
            `<option value="${od.id}">
                ${od.nombreODS}
            </option>`
        );
    });
});

// Cuando se selecciona un ODS
$('#selectOds').change(function () {

    let odsId = $(this).val();

    if (!odsId) {
        $('#odsInfo').addClass('d-none');
        return;
    }

    $.get('/ods/' + odsId, function (ods) {

        $('#odsInfo')
            .removeClass('d-none')
            .html(`
                <strong>ODS seleccionado</strong><br>
                <b>Nombre:</b> ${ods.nombreODS}<br>
                <b>Tipo:</b> ${ods.tipoODS}<br>
                <b>Descripción:</b> ${ods.descripcionODS}
            `);
    }).fail(function() {
        $('#odsInfo').html('<p class="text-danger">Error al cargar el ODS</p>');
    });
});

// Cargar todos los planes en el select
$.get('/plans/list', function(plans){
    plans.forEach(plan => {
        $('#selectPlan').append(
            `<option value="${plan.id}">${plan.nombrePlan}</option>`
        );
    });
});

// Al seleccionar un plan
$('#selectPlan').change(function(){

    let planId = $(this).val();

    if(!planId){
        $('#planInfo').addClass('d-none');
        return;
    }

    $.get('/plans/' + planId, function(plan){
        $('#planInfo')
            .removeClass('d-none')
            .html(`
                <strong>Plan seleccionado</strong><br>
                <b>Nombre:</b> ${plan.nombrePlan}<br>
                <b>Descripción:</b> ${plan.descripcionPlan ?? '—'}<br>
                <b>Estado:</b> ${plan.estadoPlan ?? '—'}<br>
                <b>Fecha Inicio:</b> ${plan.fechaInicio ?? '—'}<br>
                <b>Fecha Fin:</b> ${plan.fechaFin ?? '—'}<br>
                <hr>
                <b>Entidad Responsable:</b><br>
                ${plan.entidad 
                    ? `${plan.entidad.nombreEntidad} (${plan.entidad.tipoEntidad}, ${plan.entidad.direccionEntidad})` 
                    : '<em>No hay entidad asignada</em>'}
            `);
    }).fail(function(){
        $('#planInfo').html('<p class="text-danger">Error al cargar el Plan</p>');
    });
});


   // Cargar todas las Metas en el select
$.get('/metas/list', function(metas){
    metas.forEach(meta => {
        $('#selectMeta').append(
            `<option value="${meta.id}">${meta.nombreMeta}</option>`
        );
    });
});

// Al seleccionar una Meta
$('#selectMeta').change(function(){

    let metaId = $(this).val();

    if(!metaId){
        $('#metaInfo').addClass('d-none');
        return;
    }

    $.get('/metas/' + metaId, function(meta){

        let indicadoresHTML = '<ul>';
        if(meta.indicadores && meta.indicadores.length > 0){
            meta.indicadores.forEach(ind => {
                indicadoresHTML += `<li>${ind.codigoIndicador ?? ''} - ${ind.nombreIndicador}</li>`;
            });
        } else {
            indicadoresHTML = '<p class="text-muted">No hay indicadores asociados.</p>';
        }
        indicadoresHTML += '</ul>';

        $('#metaInfo')
            .removeClass('d-none')
            .html(`
                <strong>Meta seleccionada</strong><br>
                <b>Código:</b> ${meta.codigoMeta}<br>
                <b>Nombre:</b> ${meta.nombreMeta}<br>
                <b>Descripción:</b> ${meta.descripcionMeta ?? '—'}<br>
                <b>Estado:</b> ${meta.estadoMeta ?? '—'}<br><hr>
                <b>Objetivo Estratégico (OE):</b><br>
                ${meta.oe ? `${meta.oe.codigoOE} - ${meta.oe.nombreOE}` : '<em>No asignado</em>'}<br><hr>
                <b>Indicadores:</b><br>
                ${indicadoresHTML}
            `);

    }).fail(function(){
        $('#metaInfo').html('<p class="text-danger">Error al cargar la Meta</p>');
    });
});


// Cargar todos los Programas en el select
$.get('/programas/list', function(programas){
    programas.forEach(prog => {
        $('#selectPrograma').append(
            `<option value="${prog.id}">${prog.nombrePrograma}</option>`
        );
    });
});

// Al seleccionar un Programa
$('#selectPrograma').change(function(){

    let progId = $(this).val();

    if(!progId){
        $('#programaInfo').addClass('d-none');
        return;
    }

    $.get('/programas/' + progId, function(prog){

        let proyectosHTML = '<ul>';
        if(prog.proyectos && prog.proyectos.length > 0){
            prog.proyectos.forEach(p => {
                proyectosHTML += `<li>${p.nombreProyecto} (${p.estadoProyecto})</li>`;
            });
        } else {
            proyectosHTML = '<p class="text-muted">No hay proyectos asociados.</p>';
        }
        proyectosHTML += '</ul>';

        $('#programaInfo')
            .removeClass('d-none')
            .html(`
                <strong>Programa seleccionado</strong><br>
                <b>Nombre:</b> ${prog.nombrePrograma}<br>
                <b>Tipo:</b> ${prog.tipoPrograma}<br>
                <b>Descripción:</b> ${prog.descripcionPrograma ?? '—'}<br>
                <b>Estado:</b> ${prog.estadoPrograma ?? '—'}<br>
                <b>Responsable:</b> ${prog.responsablePrograma ?? '—'}<br><hr>
                <b>Proyectos:</b><br>
                ${proyectosHTML}
            `);

    }).fail(function(){
        $('#programaInfo').html('<p class="text-danger">Error al cargar el Programa</p>');
    });
});

// Cargar todos los Proyectos en el select
$.get('/proyectos/list', function(proyectos){
    proyectos.forEach(proy => {
        $('#selectProyecto').append(
            `<option value="${proy.id}">${proy.nombreProyecto}</option>`
        );
    });
});

// Al seleccionar un Proyecto
$('#selectProyecto').change(function(){

    let proyectoId = $(this).val();

    if(!proyectoId){
        $('#proyectoInfo').addClass('d-none');
        return;
    }

    $.get('/proyectos/' + proyectoId, function(proy){

        let indicadoresHTML = '<ul>';
        if(proy.indicadores && proy.indicadores.length > 0){
            proy.indicadores.forEach(ind => {
                indicadoresHTML += `<li>${ind.codigoIndicador ?? ''} - ${ind.nombreIndicador ?? ''}</li>`;
            });
        } else {
            indicadoresHTML = '<p class="text-muted">No hay indicadores asociados.</p>';
        }
        indicadoresHTML += '</ul>';

        $('#proyectoInfo')
            .removeClass('d-none')
            .html(`
                <strong>Proyecto seleccionado</strong><br>
                <b>Nombre:</b> ${proy.nombreProyecto}<br>
                <b>Descripción:</b> ${proy.descripcionProyecto ?? '—'}<br>
                <b>Estado:</b> ${proy.estadoProyecto ?? '—'}<br>
                <b>Responsable:</b> ${proy.responsableProyecto ?? '—'}<br><hr>
                <b>Programa:</b><br>
                ${proy.programa 
                    ? `${proy.programa.nombrePrograma} (${proy.programa.tipoPrograma})` 
                    : '<em>No asignado</em>'}<br><hr>
                <b>Indicadores:</b><br>
                ${indicadoresHTML}
            `);

    }).fail(function(){
        $('#proyectoInfo').html('<p class="text-danger">Error al cargar el Proyecto</p>');
    });
});

$('#exportPdf').click(function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let y = 10; // posición vertical inicial

    function addText(title, content) {
        doc.setFontSize(14);
        doc.text(title, 10, y);
        y += 6;
        doc.setFontSize(11);
        content.split('<br>').forEach(line => {
            doc.text(line.replace(/<[^>]+>/g, ''), 12, y);
            y += 6;
        });
        y += 4;
    }

    // Entidad
    if($('#entidadInfo').hasClass('d-none') === false) {
        addText('Entidad', $('#entidadInfo').html());
    }

    // PDN
    if($('#pdnInfo').hasClass('d-none') === false) {
        addText('PDN', $('#pdnInfo').html());
    }

    // OE
    if($('#oesList').html().trim() !== '') {
        addText('Objetivos Estratégicos', $('#oesList').html());
    }

    // ODS
    if($('#odsInfo').hasClass('d-none') === false) {
        addText('ODS', $('#odsInfo').html());
    }

    // Plan
    if($('#planInfo').hasClass('d-none') === false) {
        addText('Plan Institucional', $('#planInfo').html());
    }

    // Meta
    if($('#metaInfo').hasClass('d-none') === false) {
        addText('Meta', $('#metaInfo').html());
    }

    // Programa
    if($('#programaInfo').hasClass('d-none') === false) {
        addText('Programa', $('#programaInfo').html());
    }

    // Proyecto
    if($('#proyectoInfo').hasClass('d-none') === false) {
        addText('Proyecto', $('#proyectoInfo').html());
    }

    // Descargar PDF
    doc.save('SIPeIP_Export.pdf');
});



   
});




</script>
@endsection
