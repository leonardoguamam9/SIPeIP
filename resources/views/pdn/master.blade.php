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

    <div id="ajaxResponseAlert" class="alert d-none mt-3" role="alert"></div>

    <div class="d-grid gap-2 mt-4 mb-5">
        <button id="btnGuardarBaseDatos" class="btn btn-primary btn-lg mb-2">
            <i class="fas fa-save"></i> Guardar Consolidación en Base de Datos
        </button>
        <button id="exportPdf" class="btn btn-success btn-lg">
            <i class="fas fa-file-pdf"></i> Exportar todo a PDF
        </button>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
$(document).ready(function () {

    // --- CARGA INICIAL DE LOS SELECTS ---

    // Entidades
    $.get('/entidades/list', function (data) {
        data.forEach(entidad => {
            $('#selectEntidad').append(`<option value="${entidad.id}">${entidad.nombreEntidad}</option>`);
        });
    });

    // PDN
    $.get('/pdns/list', function (data) {
        data.forEach(pdn => {
            $('#selectPdn').append(`<option value="${pdn.id}">${pdn.codigoPDN} - ${pdn.nombrePDN}</option>`);
        });
    });

    // ODS
    $.get('/ods/list', function (ods) {
        ods.forEach(od => {
            $('#selectOds').append(`<option value="${od.id}">${od.nombreODS}</option>`);
        });
    });

    // Planes
    $.get('/plans/list', function(plans){
        plans.forEach(plan => {
            $('#selectPlan').append(`<option value="${plan.id}">${plan.nombrePlan}</option>`);
        });
    });

    // Metas
    $.get('/metas/list', function(metas){
        metas.forEach(meta => {
            $('#selectMeta').append(`<option value="${meta.id}">${meta.nombreMeta}</option>`);
        });
    });

    // Programas
    $.get('/programas/list', function(programas){
        programas.forEach(prog => {
            $('#selectPrograma').append(`<option value="${prog.id}">${prog.nombrePrograma}</option>`);
        });
    });

    // Proyectos
    $.get('/proyectos/list', function(proyectos){
        proyectos.forEach(proy => {
            $('#selectProyecto').append(`<option value="${proy.id}">${proy.nombreProyecto}</option>`);
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
                    <b>Repositorio:</b> ${pdn.url_repositorio ? `<a href="${pdn.url_repositorio}" target="_blank">Ver repositorio</a>` : '—'}<br><hr>
                    <b>Observaciones:</b><br>${pdn.observaciones ?? '—'}
                `);
        });

        $.get('/pdns/' + pdnId + '/oes', function (oes) {
            if (!oes || oes.length === 0) {
                $('#oesList').html('<p class="text-muted">Este PDN no tiene Objetivos Estratégicos.</p>');
                return;
            }
            let html = '<ul class="list-group">';
            oes.forEach(oe => {
                html += `<li class="list-group-item"><strong>${oe.codigoOE ?? ''}</strong> ${oe.nombreOE}</li>`;
            });
            html += '</ul>';
            $('#oesList').html(html);
        });
    });

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
                    <b>Fecha Fin:</b> ${plan.fechaFin ?? '—'}<br><hr>
                    <b>Entidad Responsable:</b><br>
                    ${plan.entidad ? `${plan.entidad.nombreEntidad} (${plan.entidad.tipoEntidad}, ${plan.entidad.direccionEntidad})` : '<em>No hay entidad asignada</em>'}
                `);
        }).fail(function(){
            $('#planInfo').html('<p class="text-danger">Error al cargar el Plan</p>');
        });
    });

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
                    <b>Indicadores:</b><br>${indicadoresHTML}
                `);
        }).fail(function(){
            $('#metaInfo').html('<p class="text-danger">Error al cargar la Meta</p>');
        });
    });

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
                    <b>Proyectos:</b><br>${proyectosHTML}
                `);
        }).fail(function(){
            $('#programaInfo').html('<p class="text-danger">Error al cargar el Programa</p>');
        });
    });

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
                    indicadoresHTML += `<li>${ind.codigoIndicador} - ${ind.nombreIndicador}</li>`;
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
                    <b>Indicadores:</b><br>${indicadoresHTML}
                `);
        }).fail(function(){
            $('#proyectoInfo').html('<p class="text-danger">Error al cargar el Proyecto</p>');
        });
    });


    //  GUARDAR LA CONSOLIDACIÓN EN LA BASE DE DATOS VIA POST ---
    $('#btnGuardarBaseDatos').click(function() {
        
        $('#ajaxResponseAlert').addClass('d-none').removeClass('alert-success alert-danger');

        
        let payload = {
            _token: '{{ csrf_token() }}', 
            entidad_id: $('#selectEntidad').val(),
            pdn_id: $('#selectPdn').val(),
            ods_id: $('#selectOds').val(),
            plan_id: $('#selectPlan').val(),
            meta_id: $('#selectMeta').val(),
            programa_id: $('#selectPrograma').val(),
            proyecto_id: $('#selectProyecto').val()
        };

      
        if (!payload.proyecto_id) {
            $('#ajaxResponseAlert')
                .removeClass('d-none')
                .addClass('alert-danger')
                .html('<strong>Validación del Sistema:</strong> Debe seleccionar obligatoriamente un Proyecto para consolidar el reporte.');
            return;
        }

        
        let btn = $(this);
        btn.prop('disabled', true).text('Procesando y guardando...');

       
        $.post('/reporte-maestros/guardar', payload, function(response) {
            $('#ajaxResponseAlert')
                .removeClass('d-none')
                .addClass('alert-success')
                .html('<strong>¡Éxito!</strong> La estructura del Panel Maestro ha sido registrada y auditada de forma permanente.');
            
           
            $('html, body').animate({ scrollTop: $('#ajaxResponseAlert').offset().top - 100 }, 500);
        })
        .fail(function(xhr) {
            let errorMsg = 'Ocurrió un inconveniente al comunicarse con el servidor.';
            if(xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            $('#ajaxResponseAlert')
                .removeClass('d-none')
                .addClass('alert-danger')
                .html('<strong>Error de Guardado:</strong> ' + errorMsg);
        })
        .always(function() {
           
            btn.prop('disabled', false).html('<i class="fas fa-save"></i> Guardar Consolidación en Base de Datos');
        });
    });


    
    $('#exportPdf').click(function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        let y = 15;
        const marginX = 12;
        const pageHeight = doc.internal.pageSize.height;

        function addTextSafe(title, rawHtml) {
            if (!rawHtml || rawHtml.trim() === '') return;
            
            if (y + 15 > pageHeight) { doc.addPage(); y = 15; }

            doc.setFontSize(13);
            doc.setFont("helvetica", "bold");
            doc.text(title, marginX, y);
            y += 6;

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");
            
            let lines = rawHtml.split('<br>');
            lines.forEach(line => {
                let cleanLine = line.replace(/<[^>]+>/g, '').trim();
                if (cleanLine !== '') {
                    let splitLines = doc.splitTextToSize(cleanLine, 185);
                    splitLines.forEach(textLine => {
                        if (y + 7 > pageHeight) { doc.addPage(); y = 15; }
                        doc.text(textLine, marginX + 3, y);
                        y += 6;
                    });
                }
            });
            y += 4;
        }

        if(!$('#entidadInfo').hasClass('d-none')) { addTextSafe('Entidad', $('#entidadInfo').html()); }
        if(!$('#pdnInfo').hasClass('d-none')) { addTextSafe('Plan Nacional de Desarrollo (PDN)', $('#pdnInfo').html()); }
        if($('#oesList').html().trim() !== '' && !$('#oesList').text().includes('Seleccione un PDN')) { 
            addTextSafe('Objetivos Estratégicos (OE)', $('#oesList').html()); 
        }
        if(!$('#odsInfo').hasClass('d-none')) { addTextSafe('Objetivos de Desarrollo Sostenible (ODS)', $('#odsInfo').html()); }
        if(!$('#planInfo').hasClass('d-none')) { addTextSafe('Plan Institucional', $('#planInfo').html()); }
        if(!$('#metaInfo').hasClass('d-none')) { addTextSafe('Meta', $('#metaInfo').html()); }
        if(!$('#programaInfo').hasClass('d-none')) { addTextSafe('Programa', $('#programaInfo').html()); }
        if(!$('#proyectoInfo').hasClass('d-none')) { addTextSafe('Proyecto', $('#proyectoInfo').html()); }

        doc.save('SIPeIP_Export.pdf');
    });

});
</script>
@endsection