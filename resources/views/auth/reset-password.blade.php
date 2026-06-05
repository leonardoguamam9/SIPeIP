@extends('layouts.guest')

@section('title', 'Restablecer Contraseña')

@section('content')

{{-- Contenedor principal con el degradado institucional unificado --}}
<div class="d-flex justify-content-center align-items-center dynamic-bg" style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
    
    <div class="card auth-card border-0 shadow-lg p-4 m-3" style="width: 100%; max-width: 420px; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(10px); border-radius: 16px;">

        {{-- Cabecera con identidad del Módulo de Seguridad --}}
        <div class="text-center mb-4">
            <div class="brand-logo-container mb-2 d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow" style="width: 60px; height: 60px;">
                <i class="bi bi-shield-check fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Restablecer Contraseña</h4>
            <p class="text-muted small px-2">
                Ingresa tus nuevas credenciales de acceso para asegurar y actualizar tu cuenta en el SIPeIP.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="needs-validation">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Input de Correo Electrónico (Solo lectura o precargado por Laravel) --}}
            <div class="mb-3">
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
                        value="{{ old('email', $request->email) }}"
                        required
                        style="border-radius: 0 8px 8px 0; padding: 10px 12px;"
                    >
                    @error('email')
                        <div class="invalid-feedback fw-bold small mt-1">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Input de Nueva Contraseña --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Nueva Contraseña</label>
                <div class="input-group has-validation">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        class="form-control bg-light border-start-0 @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                        autofocus
                        style="border-radius: 0 8px 8px 0; padding: 10px 12px;"
                    >
                    @error('password')
                        <div class="invalid-feedback fw-bold small mt-1">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Input de Confirmar Contraseña --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small">Confirmar Contraseña</label>
                <div class="input-group has-validation">
                    <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                        <i class="bi bi-lock-check-fill"></i>
                    </span>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control bg-light border-start-0 @error('password_confirmation') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                        style="border-radius: 0 8px 8px 0; padding: 10px 12px;"
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback fw-bold small mt-1">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Botón de Acción con Efecto de Elevación --}}
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary fw-bold btn-submit" style="border-radius: 8px; padding: 11px; transition: all 0.3s ease;">
                    Actualizar Contraseña <i class="bi bi-check-circle-fill ms-1 small align-middle"></i>
                </button>
            </div>
        </form>

    </div>
</div>


@endsection