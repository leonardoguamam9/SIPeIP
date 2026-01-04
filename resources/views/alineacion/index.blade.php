@extends('layouts.app')

@section('title','Alineación Estratégica')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">Alineación Estratégica (OE → Metas → Indicadores)</h3>

    @foreach($oes as $oe)
        <div class="card mb-3 shadow">

            <div class="card-header bg-primary text-white">
                <strong>OE:</strong> {{ $oe->codigoOE }} - {{ $oe->nombreOE }}
            </div>

            <div class="card-body">

                @forelse($oe->metas as $meta)
                    <div class="mb-3">

                        <h6 class="text-success">
                            Meta: {{ $meta->codigoMeta }} - {{ $meta->nombreMeta }}
                        </h6>

                        <ul>
                            @forelse($meta->indicadores as $indicador)
                                <li>
                                    <strong>{{ $indicador->codigoIndicador }}</strong> -
                                    {{ $indicador->nombreIndicador }}
                                    ({{ $indicador->estadoIndicador }})
                                </li>
                            @empty
                                <li class="text-muted">
                                    No hay indicadores registrados
                                </li>
                            @endforelse
                        </ul>

                    </div>
                @empty
                    <p class="text-muted">
                        No existen metas asociadas a este OE
                    </p>
                @endforelse

            </div>
        </div>
    @endforeach

</div>

@endsection
