@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $roleId = auth()->user()->role_id;
@endphp

<div class="container">

<div class="container">

    {{-- Bienvenida --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow p-4 text-center">
                <h4 class="mb-2">
                    Bienvenido al Sistema de Gestión de la Planificación – SIPeIP
                </h4>
                <p class="text-muted mb-0">
                    Seleccione una opción para comenzar su trabajo
                </p>
            </div>
        </div>
    </div>

    {{-- Accesos rápidos --}}

<div class="row g-4 justify-content-center">

    {{-- ================= ADMINISTRADOR ================= --}}
    @if(auth()->user()->role_id == 1)

        {{-- Entidades --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Entidades</h5>
                    <p class="card-text text-muted">Gestión de entidades institucionales</p>
                    <a href="{{ route('entidades.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Programas --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Programas</h5>
                    <p class="card-text text-muted">Gestión de programas institucionales</p>
                    <a href="{{ route('programa.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- ODS --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">ODS</h5>
                    <p class="card-text text-muted">Objetivos de Desarrollo Sostenible</p>
                    <a href="{{ route('ods.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Proyectos --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Proyectos</h5>
                    <p class="card-text text-muted">Gestión de proyectos institucionales</p>
                    <a href="{{ route('proyecto.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Planes --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Planes Institucionales</h5>
                    <p class="card-text text-muted">Planificación estratégica institucional</p>
                    <a href="{{ route('planes.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Indicadores --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Indicadores</h5>
                    <p class="card-text text-muted">Seguimiento y evaluación</p>
                    <a href="{{ route('indicadores.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Metas --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Metas</h5>
                    <p class="card-text text-muted">Creación de Metas</p>
                    <a href="{{ route('metas.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- OE --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Objetivos Estratégicos</h5>
                    <p class="card-text text-muted">Creación de Objetivos Estratégicos</p>
                    <a href="{{ route('oe.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- PDN --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Plan Nacional de Desarrollo</h5>
                    <p class="card-text text-muted">Creación de Plan Nacional de Desarrollo</p>
                    <a href="{{ route('pdn.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Alineación --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Alineación</h5>
                    <p class="card-text text-muted">Gestión de la Alineación</p>
                    <a href="{{ route('alineacion.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        {{-- Gestión de Usuarios --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <p class="card-text text-muted">Gestión de Usuarios</p>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

         {{-- Gestión de Roles --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Roles</h5>
                    <p class="card-text text-muted">Gestión de Roles</p>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

    {{-- ================= TECNICO ================= --}}
   @elseif(auth()->user()->role_id == 4)

         @if(auth()->user()->role_id == 4)
         {{-- Planes --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Planes Institucionales</h5>
                    <p class="card-text text-muted">Planificación estratégica institucional</p>
                    <a href="{{ route('planes.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        
          {{-- Programas --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Programas</h5>
                    <p class="card-text text-muted">Gestión de programas institucionales</p>
                    <a href="{{ route('programa.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>

        
        {{-- Proyectos --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Proyectos</h5>
                    <p class="card-text text-muted">Gestión de proyectos institucionales</p>
                    <a href="{{ route('proyecto.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>


          {{-- OE --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Objetivos Estratégicos</h5>
                    <p class="card-text text-muted">Creación de Objetivos Estratégicos</p>
                    <a href="{{ route('oe.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
        
          {{-- Metas --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Metas</h5>
                    <p class="card-text text-muted">Creación de Metas</p>
                    <a href="{{ route('metas.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>


       {{-- Indicadores --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Indicadores</h5>
                    <p class="card-text text-muted">Seguimiento y evaluación</p>
                    <a href="{{ route('indicadores.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
        
        
        {{-- Alineación --}}
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Alineación</h5>
                    <p class="card-text text-muted">Gestión de la Alineación</p>
                    <a href="{{ route('alineacion.index') }}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    @endif

    @endif

</div>

    </div>

</div>

@endsection


