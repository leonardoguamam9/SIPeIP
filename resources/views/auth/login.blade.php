@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')

{{-- Contenedor principal  --}}
<div class="d-flex justify-content-center align-items-center dynamic-bg" style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
    
    <div class="card auth-card border-0 shadow-lg p-4 m-3" style="width: 100%; max-width: 420px; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(10px); border-radius: 16px;">

        {{-- Cabecera con identidad del Sistema --}}
        <div class="text-center mb-4">
            <div class="brand-logo-container mb-2 d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow" style="width: 60px; height: 60px;">
                <i class="bi bi-shield-lock-fill fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">SIPeIP</h4>
            <p class="text-muted small">Sistema Integrado de Planificación e Inversión Pública</p>
        </div>

        {{-- Alertas de estado del sistema --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="needs-validation">
            @csrf

            {{-- correo electronico estilizado --}}
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

            {{-- contraseña estilizada --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Contraseña</label>
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
                        style="border-radius: 0 8px 8px 0; padding: 10px 12px;"
                    >
                    @error('password')
                        <div class="invalid-feedback fw-bold small mt-1">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Opciones de Recordar Cuenta --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check m-0">
                    <input
                        type="checkbox"
                        class="form-check-input cursor-pointer"
                        name="remember"
                        id="remember"
                        style="cursor: pointer;"
                    >
                    <label class="form-check-label text-secondary small cursor-pointer" for="remember" style="cursor: pointer; user-select: none;">
                        Recordarme
                    </label>
                </div>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none small fw-semibold transition-link text-primary">
                        ¿Olvidaste tu clave?
                    </a>
                @endif
            </div>

            {{-- Botón de Ingreso  --}}
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary fw-bold py-2-5 shadow-sm btn-submit" style="border-radius: 8px; padding: 11px; transition: all 0.3s ease;">
                    Ingresar al Sistema <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                </button>
            </div>

        </form>

    </div>
</div>


@endsection