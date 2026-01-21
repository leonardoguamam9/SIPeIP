@extends('layouts.app')

@section('content')
<div class="container">

<h2>📊 Visión General del SIPeIP</h2>

@foreach ($entidades as $entidad)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Entidad: {{ $entidad->nombreEntidad }}
        </div>

        <div class="card-body">
        @foreach ($entidad->pdns as $pdn)
            <h5>
                     📄 PDN: {{ $pdn->nombrePDN }}
                     <a href="{{ route('pdn.edit', [
                             'pdn' => $pdn->id,
                             'redirect' => route('sipeip.vision-general')
                             ]) }}"
                             class="btn btn-sm btn-outline-warning ms-2">
                            ✏️ Editar
                        </a>

                    </h5>

            @foreach ($pdn->oes as $oe)
                <div class="ms-3">
                    <strong>🎯 OE:</strong> {{ $oe->nombreOE }}
                    <a href="{{ route('oe.edit', [
                'oe' => $oe->id,
                'redirect' => route('sipeip.vision-general')
                ]) }}"
                class="btn btn-sm btn-outline-primary ms-2">
                ✏️ Editar
                </a>
                  
                    {{-- METAS --}}
                    <ul>
                        @foreach ($oe->metas as $meta)
                            <li>
                                🧩 Meta: {{ $meta->nombreMeta }}
                                <a href="{{ route('metas.edit', [
                                'meta' => $meta->id,
                                'redirect' => route('sipeip.vision-general')
                                ]) }}"
                                class="btn btn-sm btn-outline-success ms-2">
                                ✏️ Editar
                                </a>


                                <ul>
                                    @foreach ($meta->indicadores as $indicador)
                                        <li>
                        📈 Indicador: {{ $indicador->nombreIndicador }}
                        <a href="{{ route('indicadores.edit', [
                        'indicadore' => $indicador->id,
                        'redirect' => route('sipeip.vision-general')
                        ]) }}"
                        class="btn btn-sm btn-outline-danger ms-2">
                        ✏️ Editar
                        </a>

                            </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>

                   
                </div>
            @endforeach
        @endforeach
        </div>
    </div>
@endforeach

</div>
@endsection
