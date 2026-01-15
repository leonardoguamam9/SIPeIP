@extends('layouts.app')

@section('title','Recuperar contraseña')

@section('content')

<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

        <h4 class="text-center mb-3">¿Olvidaste tu contraseña?</h4>

        <p class="text-center text-muted mb-4">
            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
        </p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-grid">
                <button class="btn btn-primary">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">
                Volver al inicio de sesión
            </a>
        </div>

    </div>
</div>

@endsection
