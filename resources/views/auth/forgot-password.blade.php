@extends('layouts.guest')

@section('title', 'Recuperar Contraseña')

@section('content')

{{-- Contenedor principal con el degradado institucional unificado --}}
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
    
    <div class="card auth-card border-0 shadow-lg p-4 m-3" style="width: 100%; max-width: 420px; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(10px); border-radius: 16px;">

        {{-- Cabecera con identidad del Módulo de Seguridad --}}
        <div class="text-center mb-4">
            <div class="brand-logo-container mb-2 d-inline-flex align-items-center justify-content-center bg-warning text-dark rounded-circle shadow" style="width: 60px; height: 60px;">
                <i class="bi bi-key-fill fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">¿Olvidaste tu contraseña?</h4>
            <p class="text-muted small px-2">
                Ingresa tu correo institucional registrado y te enviaremos un enlace seguro para restablecer tus credenciales.
            </p>
        </div>

        {{-- Alerta Estilizada de Éxito al Enviar el Enlace --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm text-center mb-4" role="alert" style="border-radius: 8px;">
                <div class="fw-bold mb-1"><i class="bi bi-envelope-check-fill me-1 fs-5"></i> ¡Correo Enviado!</div>
                <small class="d-block text-secondary">{{ session('status') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Input de Correo Electrónico con Icono Enlazado --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small">Correo Electrónico</label>
                <div class="input-group has-validation">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input
                        type="email"
                        name="email"
                        class="form-control bg-light border-start-0 @error('email') is-invalid @enderror"
                        placeholder="usuario@institucion.gob.ec"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="border-radius: 0 8px 8px 0; padding: 10px 12px;"
                    >
                    @error('email')
                        <div class="invalid-feedback fw-bold small mt-1">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Botón de Acción con Efecto de Elevación y Transición --}}
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary fw-bold btn-submit" style="border-radius: 8px; padding: 11px; transition: all 0.3s ease;">
                    Enviar Enlace de Recuperación <i class="bi bi-send-fill ms-1 small align-middle"></i>
                </button>
            </div>
        </form>

        {{-- Enlace de Retorno Estilizado --}}
        <div class="text-center mt-2">
            <a href="{{ route('login') }}" class="text-decoration-none small fw-semibold transition-link text-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al inicio de sesión
            </a>
        </div>

    </div>
</div>



@endsection