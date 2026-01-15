<nav class="navbar navbar-expand-lg" style="background-color: #0055a5;">
    <div class="container-fluid">

        <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
            SIPeIP
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <a class="nav-link text-white" href="{{ route('dashboard') }}">Inicio</a>
            </ul>
            @endauth

            <ul class="navbar-nav ms-auto">

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item-text small text-muted">
                            {{ Auth::user()->email }}
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">
                        Iniciar sesión
                    </a>
                </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
