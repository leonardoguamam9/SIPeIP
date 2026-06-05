<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPeIP - Sistema Integrado de Planificación e Inversión Pública</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .hero-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            min-height: 75vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            opacity: 0.1;
        }
        .feature-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
        }
        .btn-enter {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-enter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="bi bi-shield-lock-fill text-primary me-2"></i> SIPeIP
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-light px-4 font-semibold" style="border-radius: 8px;">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Acceder al Portal
                </a>
            </div>
        </div>
    </nav>

    <header class="hero-section text-white text-center text-md-start">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-md-7">
                    <span class="badge bg-primary px-3 py-2 mb-3 text-uppercase fw-bold shadow-sm">Plataforma Institucional</span>
                    <h1 class="display-4 fw-bold lh-sm mb-3">
                        Sistema Integrado de Planificación e Inversión Pública
                    </h1>
                    <p class="lead text-white-50 mb-4">
                        Optimización, seguimiento institucional y control estratégico de techos presupuestarios y proyectos gubernamentales alineados al desarrollo fiscal.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-md-start">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-enter btn-lg shadow">
                            Ingresar al Sistema <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#objetivos" class="btn btn-outline-light btn-enter btn-lg">
                            Conocer más
                        </a>
                    </div>
                </div>
                <div class="col-md-5 d-none d-md-block text-center">
                    <div class="p-4 bg-white bg-opacity-10 rounded-4 backdrop-blur shadow-lg border border-white border-opacity-10">
                        <i class="bi bi-graph-up-arrow display-1 text-primary mb-3 d-block"></i>
                        <span class="fs-5 font-monospace text-white-50">Sincronizado con Ministerio de Finanzas</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="objetivos" class="container my-5 py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Componentes de Control Fiscal</h2>
            <p class="text-muted max-w-2xl mx-auto">Ejes tecnológicos integrados en la arquitectura central del SIPeIP.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 p-4 shadow-sm feature-card">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 d-inline-block mb-4" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-bank fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Interconexión MF</h5>
                    <p class="text-muted small mb-0">
                        Consistencia directa de transferencias presupuestarias validadas y reportes automatizados de auditoría bajo normativa vigente.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 shadow-sm feature-card">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 d-inline-block mb-4" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Auditoría</h5>
                    <p class="text-muted small mb-0">
                        Registro inmutable de transacciones, control estricto de accesos por roles, módulos e IPs para blindaje institucional.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 shadow-sm feature-card">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 d-inline-block mb-4" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-pie-chart-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Indicadores</h5>
                    <p class="text-muted small mb-0">
                        Monitoreo analítico de metas institucionales, distribución financiera equitativa y parametrización de periodos fiscales activos.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white-50 text-center py-4 border-top border-secondary border-opacity-25">
        <div class="container">
            <p class="mb-1 small">&copy; {{ date('Y') }} SIPeIP - Todos los derechos reservados.</p>
            <p class="mb-0 fs-7 text-muted">Desplegado en Servidor Local de una Sola Capa de Datos.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>