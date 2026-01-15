@extends('layouts.app')

@section('title','Restablecer contraseña')

@section('content')

<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

        <h4 class="text-center mb-4">Restablecer contraseña</h4>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $request->email) }}"
                    required
                >
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="form-label">Confirmar contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required
                >
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-grid">
                <button class="btn btn-success">
                    Restablecer contraseña
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
