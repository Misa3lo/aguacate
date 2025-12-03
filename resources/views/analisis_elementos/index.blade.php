@extends('layouts.app')

@section('title', 'Resultados del Análisis de Elementos')

@section('content')

    @if ($analisis->isEmpty())
        <div class="empty-state">
            <p><i class="fas fa-exclamation-circle"></i> No hay análisis registrados aún.</p>
            <p>Los análisis se generan automáticamente una vez que se procesan los valores de las muestras y las referencias.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Muestra ID</th>
                <th>Índice Kenworthy</th>
                <th>Nivel de Suficiencia</th>
                <th>Necesidad de Aplicación</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($analisis as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->parcela_elemento_id }}</td>
                    <td>{{ number_format($item->ind_kenworthy, 4) }}</td>

                    <td>
                        @php
                            $class = '';
                            if ($item->nivel_suficiencia == 'bajo') {
                                $class = 'badge-danger';
                            } elseif ($item->nivel_suficiencia == 'normal') {
                                $class = 'badge-success';
                            } else {
                                $class = 'badge-warning';
                            }
                        @endphp
                        <span class="badge {{ $class }}">{{ strtoupper($item->nivel_suficiencia) }}</span>
                    </td>

                    <td>
                        @php
                            $class = $item->necesidad_aplicacion == 'aplicar' ? 'badge-error' : 'badge-primary';
                        @endphp
                        <span class="badge {{ $class }}">{{ strtoupper($item->necesidad_aplicacion) }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
    <style>
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        .badge-success { background-color: var(--color-success); color: white; }
        .badge-danger { background-color: var(--color-error); color: white; }
        .badge-warning { background-color: orange; color: white; }
        .badge-primary { background-color: var(--color-primary); color: white; }
        .badge-error { background-color: var(--color-error); color: white; }
    </style>
@endsection
