@extends('layouts.app')

@section('title', 'Resultados: Índice de Kenworthy')

@section('content')

    @if ($analisis->isEmpty())
        <div class="empty-state">
            <i class="fas fa-microscope"></i>
            <h3>No hay análisis generados</h3>
            <p>Calcula los índices ingresando primero los valores en "Ingreso de Muestras".</p>
            <a href="{{ route('muestreos.index') }}" class="btn btn-primary mt-3">Ir a Muestreos</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Muestra / Elemento</th>
                    <th>Índice Kenworthy</th>
                    <th>Estado Nutricional</th>
                    <th>Recomendación</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($analisis as $item)
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>
                        <td>
                            <i class="fas fa-leaf text-success"></i>
                            {{ $item->parcela_elemento_id }} </td>
                        <td class="fw-bold text-center">
                            {{ number_format($item->ind_kenworthy, 2) }}
                        </td>
                        <td>
                            @php
                                // Lógica de colores basada en el índice
                                $nivel = strtolower($item->nivel_suficiencia);
                                $bgNivel = 'bg-normal';
                                if($nivel == 'bajo' || $nivel == 'deficiente') $bgNivel = 'bg-bajo';
                                if($nivel == 'alto' || $nivel == 'exceso') $bgNivel = 'bg-alto';
                            @endphp
                            <span class="badge {{ $bgNivel }}">
                                    {{ $item->nivel_suficiencia }}
                                </span>
                        </td>
                        <td>
                            @if(strtolower($item->necesidad_aplicacion) == 'aplicar')
                                <span class="badge bg-aplicar">
                                        <i class="fas fa-hand-holding-droplet"></i> APLICAR
                                    </span>
                            @else
                                <span class="badge bg-no-aplicar">
                                        SIN ACCIÓN
                                    </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
