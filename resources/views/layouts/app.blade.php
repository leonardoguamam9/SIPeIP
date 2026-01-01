<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPeIP - @yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos propios --}}
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f2f2f2;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 15px;
        }

        nav {
            background-color: #0055a5;
            padding: 10px;
        }

        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #ddd;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido al Sistema de Gestión de la Planificación  - SIPeIP</h1>
</header>

<nav>
    <a href="{{ url('/') }}">Inicio</a>
    <a href="{{ route('entidades.index') }}">Entidades</a>
    <a href="{{ route('programa.index') }}">Programas</a>
    <a href="{{ route('ods.index') }}">ODS</a>
    <a href="{{ route('proyecto.index') }}">Proyectos</a>
    <a href="{{ route('planes.index') }}">Planes Institucionales</a>
</nav>

<main class="container my-5">
    @yield('content')
</main>

<footer>
    <small>&copy; SIPeIP</small>
</footer>

</body>
</html>
