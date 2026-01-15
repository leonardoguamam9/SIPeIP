@extends('layouts.app')

@section('title','Editar PDN')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <div class="card shadow p-4">

                <h4 class="text-center mb-4">
                    Editar Plan Nacional de Desarrollo (PDN)
                </h4>

                <form action="{{ route('pdn.update', $pdn->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Código y Nombre --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Código PDN</label>
                            <input type="text" name="codigoPDN" class="form-control"
                                   value="{{ old('codigoPDN', $pdn->codigoPDN) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre del PDN</label>
                            <input type="text" name="nombrePDN" class="form-control"
                                   value="{{ old('nombrePDN', $pdn->nombrePDN) }}" required>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcionPDN" class="form-control" rows="3">{{ old('descripcionPDN', $pdn->descripcionPDN) }}</textarea>
                    </div>

                    {{-- Vigencia y Horizonte --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Año inicio</label>
                            <input type="number" name="anio_inicio" class="form-control"
                                   min="1900" max="2100" placeholder="Ej: 2024"
                                   value="{{ old('anio_inicio', $pdn->anio_inicio) }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Año fin</label>
                            <input type="number" name="anio_fin" class="form-control"
                                   min="1900" max="2100" placeholder="Ej: 2027"
                                   value="{{ old('anio_fin', $pdn->anio_fin) }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Horizonte</label>
                            <select name="horizonte_planificacion" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="Corto Plazo" {{ $pdn->horizonte_planificacion == 'Corto Plazo' ? 'selected' : '' }}>Corto Plazo</option>
                                <option value="Mediano Plazo" {{ $pdn->horizonte_planificacion == 'Mediano Plazo' ? 'selected' : '' }}>Mediano Plazo</option>
                                <option value="Largo Plazo" {{ $pdn->horizonte_planificacion == 'Largo Plazo' ? 'selected' : '' }}>Largo Plazo</option>
                            </select>
                        </div>
                    </div>

                    {{-- Aprobación --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de aprobación</label>
                            <input type="date" name="fecha_aprobacion" class="form-control"
                                   value="{{ old('fecha_aprobacion', $pdn->fecha_aprobacion) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Resolución de aprobación</label>
                            <input type="text" name="resolucion_aprobacion" class="form-control"
                                   value="{{ old('resolucion_aprobacion', $pdn->resolucion_aprobacion) }}">
                        </div>
                    </div>

                    {{-- Entidad y Usuario --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Entidad responsable</label>
                            <select name="entidad_id" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($entidades as $entidad)
                                    <option value="{{ $entidad->id }}" {{ $pdn->entidad_id == $entidad->id ? 'selected' : '' }}>
                                        {{ $entidad->nombreEntidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Usuario responsable</label>
                            <select name="user_id" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($usuarios as $user)
                                    <option value="{{ $user->id }}" {{ $pdn->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Responsable, Documento y Repositorio --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Responsable PDN</label>
                            <input type="text" name="responsable_pdn" class="form-control"
                                   value="{{ old('responsable_pdn', $pdn->responsable_pdn) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Documento PDN</label>
                            <input type="text" name="documentoPDN" class="form-control"
                                   value="{{ old('documentoPDN', $pdn->documentoPDN) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">URL repositorio</label>
                            <input type="url" name="url_repositorio" class="form-control"
                                   value="{{ old('url_repositorio', $pdn->url_repositorio) }}">
                        </div>
                    </div>

                    {{-- Observaciones --}}
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="2">{{ old('observaciones', $pdn->observaciones) }}</textarea>
                    </div>

                    {{-- Estado --}}
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estadoPDN" class="form-control" required>
                            <option value="Borrador" {{ $pdn->estadoPDN == 'Borrador' ? 'selected' : '' }}>Borrador</option>
                            <option value="Activo" {{ $pdn->estadoPDN == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $pdn->estadoPDN == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('pdn.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
