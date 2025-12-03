@extends('layouts.app')

@section('title', 'Recomendaciones de Aplicación de Nutrientes')

@section('content')

    @if ($recomendaciones->isEmpty())
        <div class="empty-state">
            <p><i class="fas fa-exclamation-circle"></i> No se han generado recomendaciones aún.</p>
            <p>Las recomendaciones se generan después de que los análisis de elementos han sido completados.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Análisis ID</th>
                <th>Tipo de Nutriente</th>
                <th>Cantidad Recomendada</th>
                <th>Unidad</th>
                <th>Fecha Recomendación</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($recomendaciones as $recomendacion)
                <tr>
                    <td>{{ $recomendacion->id }}</td>
                    <td>{{ $recomendacion->analisis_elemento_id }}</td>
                    <td>{{ $recomendacion->tipo_nutriente }}</td>
                    <td>{{ number_format($recomendacion->cantidad_recomendada, 2) }}</td>
                    <td>{{ $recomendacion->unidad_aplicacion }}</td>
                    <td>{{ \Carbon\Carbon::parse($recomendacion->fecha_recomendacion)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
