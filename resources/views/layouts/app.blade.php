<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SIPeIP - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Iconos de Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Fuente --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    {{-- 📥 CSS DE DATATABLES V2.3.8 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f2f2f2;
            overflow-x: hidden;
        }

        /* Control de espacio definido para pantallas grandes */
        @media (min-width: 992px) {
            .sidebar-fija {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1020;
                width: 260px; /* Ancho fijo para tu barra lateral */
            }
            .contenido-principal {
                margin-left: 260px; /* Desplazamiento exacto de la pantalla de navegación */
                width: calc(100% - 260px);
            }
        }

        /* CONTROL ESTRICTO DE ESTILOS CUANDO EXPORTAS A PDF (IMPRESIÓN) */
        @media print {
            /* 1. Selección automática de hoja horizontal */
            @page {
                size: landscape;
                margin: 8mm; /* Reducimos ligeramente el margen para ganar más espacio horizontal */
            }

            /* 2. Oculta menús, botones y buscadores */
            .sidebar-fija, 
            .btn, 
            .no-print,
            hr,
            .dt-search,
            .dt-length, 
            .dt-paging, 
            div.dt-buttons {
                display: none !important;
            }
            
            /* 3. Ajusta el contenedor principal al límite de la hoja */
            .contenido-principal {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }

            /* 4. Fuerza a los navegadores a mantener colores de badges y encabezados */
            body, table, thead, tr, th, td, .badge {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            body {
                background-color: #ffffff !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }

            /* TABLAS ULTRA ANCHAS */
            table, .table {
                width: 100% !important;
                table-layout: fixed !important; /* Obliga a la tabla a respetar los anchos asignados y no desbordarse */
                word-wrap: break-word !important; /* Rompe los textos largos (como correos o descripciones) en varias líneas */
                font-size: 10px !important; /* Reduce ligeramente la letra solo al imprimir para que quepa todo */
            }

            
            .table th, .table td {
                padding: 4px 6px !important; 
            }

           
            tr {
                page-break-inside: avoid !important;
            }
        }
    </style>
</head>
<body>

    <div class="d-lg-none p-3 text-white d-flex justify-content-between align-items-center" style="background-color: #0055a5;">
        <a class="text-white fw-bold text-decoration-none fs-4" href="{{ url('/') }}">SIPeIP</a>
        <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#colapsoSidebar">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-lg-auto sidebar-fija collapse d-lg-block" id="colapsoSidebar">
                @include('layouts.navigation')
            </div>

            <div class="col contenido-principal">
                <main class="container-fluid p-4 pt-5">
                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    {{-- 1. Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- 2. jQuery Core (Requerido por compatibilidad de plugins) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- 3. JS DE DATATABLES V2.3.8 --}}
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>

    {{-- 4. jsPDF (Centralizado para los reportes automáticos del SIPeIP) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    {{-- 5. LÓGICA DE CONTROL GLOBAL Y CENTRALIZACIÓN ESTRICTA --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
           
            if (document.querySelector('.tabla-dinamica')) {
                
               
                new DataTable('.tabla-dinamica', {
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Idioma Español
                    },
                    pageLength: 10,     // Mostrar 10 registros por página por defecto
                    responsive: true,   // Soporte multidispositivo
                    destroy: true,      // Previene errores de reinicialización en cambios de DOM
                    order: [[0, 'desc']] // Ordena por el ID de forma descendente inicialmente
                });
            }

            
            const btnExportar = document.getElementById('exportPdf');
            if (btnExportar) {
                btnExportar.addEventListener('click', function () {
                    if (typeof estructurarPDF === 'function') {
                        estructurarPDF();
                    } else {
                        alert('La estructura de datos para el PDF de este módulo no está definida.');
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>