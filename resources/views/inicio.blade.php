@extends('layouts.app')

@section('title','Inicio')

@section('content')

<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 600px;">

        <h4 class="text-center mb-4">
            Bienvenido al Sistema de Gestión de la Planificación  - SIPeIP
        </h4>

        <p class="text-center mb-4">
            Seleccione una opción del menú para comenzar:
        </p>

        <ul class="list-group">
            <li class="list-group-item text-center">
                <a href="{{ route('entidades.index') }}" class="text-decoration-none fw-bold">
                    Gestión de Entidades
            </li>
        </ul>
          <ul class="list-group">
            <li class="list-group-item text-center">
                <a href="{{ route('programa.index') }}" class="text-decoration-none fw-bold">
                    Gestión de Programas
            </li>
        </ul>  

        </ul>
          <ul class="list-group">
            <li class="list-group-item text-center">
                <a href="{{ route('ods.index') }}" class="text-decoration-none fw-bold">
                    Gestión de ODS
            </li>
        </ul>    

         </ul>
          <ul class="list-group">
            <li class="list-group-item text-center">
                <a href="{{ route('proyecto.index') }}" class="text-decoration-none fw-bold">
                    Gestión de Proyectos
            </li>
        </ul>    
    </div>
</div>

@endsection
