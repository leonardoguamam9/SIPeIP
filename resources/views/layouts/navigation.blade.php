<nav class="w-100 vh-100 d-flex flex-column p-3 text-white justify-content-between" style="background-color: #0055a5; overflow-y: auto;">
    <div>
        <a class="navbar-brand text-white fw-bold d-block text-center fs-4 my-3 text-decoration-none" href="{{ url('/') }}">
            SIPeIP
        </a>
        <hr class="text-white opacity-25">

        <ul class="nav nav-pills flex-column mb-auto">
            @auth
            <li class="nav-item mb-1">
                <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Inicio
                </a>
            </li>

            {{-- ================= MENÚ ADMINISTRADOR (role_id == 1) ================= --}}
            @if(auth()->user()->role_id == 1)
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('entidades.index') }}"><i class="bi bi-bank me-2"></i> Entidades</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('programa.index') }}"><i class="bi bi-collection me-2"></i> Programas</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('ods.index') }}"><i class="bi bi-globe me-2"></i> ODS</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('proyecto.index') }}"><i class="bi bi-folder me-2"></i> Proyectos</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('planes.index') }}"><i class="bi bi-journal-text me-2"></i> Planes</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('indicadores.index') }}"><i class="bi bi-graph-up-arrow me-2"></i> Indicadores</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('metas.index') }}"><i class="bi bi-flag me-2"></i> Metas</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('oe.index') }}"><i class="bi bi-target me-2"></i> Obj. Estratégicos</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('pdn.index') }}"><i class="bi bi-map me-2"></i> Plan Nac. Desarrollo</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('pdn.view') }}"><i class="bi bi-sliders me-2"></i> Panel Maestro PDN</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('documentos.index') }}"><i class="bi bi-file-earmark-arrow-up me-2"></i> Documentos</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('seguimientos.index') }}"><i class="bi bi-eye me-2"></i> Seguimiento</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('configuracion.index') }}"><i class="bi bi-gear me-2"></i> Config. Institucional</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('finanzas.index') }}"><i class="bi bi-cash-coin me-2"></i> Min. Finanzas</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('usuarios.index') }}"><i class="bi bi-people me-2"></i> Usuarios</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('roles.index') }}"><i class="bi bi-shield-lock me-2"></i> Roles</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('auditorias.index') }}"><i class="bi bi-clipboard-check me-2"></i> Auditoría</a></li>
            @endif

            {{-- ================= MENÚ TÉCNICO (role_id == 4) ================= --}}
            @if(auth()->user()->role_id == 4)
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('planes.index') }}"><i class="bi bi-journal-text me-2"></i> Planes Institucionales</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('programa.index') }}"><i class="bi bi-collection me-2"></i> Programas</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('proyecto.index') }}"><i class="bi bi-folder me-2"></i> Proyectos</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('oe.index') }}"><i class="bi bi-target me-2"></i> Objetivos Estratégicos</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('metas.index') }}"><i class="bi bi-flag me-2"></i> Metas</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('indicadores.index') }}"><i class="bi bi-graph-up-arrow me-2"></i> Indicadores</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="{{ route('alineacion.index') }}"><i class="bi bi-link-45deg me-2"></i> Alineación</a></li>
            @endif
            @endauth
        </ul>
    </div>

    <ul class="nav nav-pills flex-column border-top pt-3 border-white border-opacity-25 mt-3">
        @auth
        <li class="nav-item dropup">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center justify-content-between" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-truncate" style="max-width: 140px;">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu shadow w-100">
                <li class="dropdown-item-text small text-muted text-truncate">{{ Auth::user()->email }}</li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger d-flex align-items-center w-100 border-0 bg-transparent">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link text-white bg-success text-center fw-bold" href="{{ route('login') }}">Iniciar sesión</a>
        </li>
        @endauth
    </ul>
</nav>