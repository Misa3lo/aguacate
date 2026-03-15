@extends('layouts.app')

@section('title', 'Catálogo de Nutrientes')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Define los elementos químicos y sus unidades de medida (%, ppm).</p>
        <a href="{{ route('elementos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Nutriente
        </a>
    </div>

    @if ($elementos->isEmpty())
        <div class="empty-state">
            <i class="fas fa-flask"></i>
            <h3>Catálogo vacío</h3>
            <p>No se han registrado elementos (nutrientes) aún.</p>
            <p>Es necesario crear los nutrientes para poder realizar los análisis foliares.</p>
            <a href="{{ route('elementos.create') }}" class="btn btn-secondary mt-2">Crear primer nutriente</a>
        </div>
    @else
        {{-- Dentro del @else de index.blade.php --}}
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th><i class="fas fa-vial"></i> Elemento</th>
                    <th class="text-center">Unidad</th>
                    <th class="text-center"><i class="fas fa-calendar-alt"></i> Registro</th>
                    <th style="width: 120px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($elementos as $elemento)
                    <tr>
                        <td class="text-muted">#{{ $elemento->Id }}</td>
                        <td><strong>{{ $elemento->Name }}</strong></td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">{{ $elemento->Unit }}</span>
                        </td>
                        <td class="text-center" style="font-size: 0.9em;">
                            {{-- Usando el nombre exacto de la columna: Created_at --}}
                            @if($elemento->Created_at)
                                <div>{{ $elemento->Created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $elemento->Created_at->format('H:i') }}</small>
                            @else
                                <span class="text-muted">---</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('elementos.edit', $elemento->Id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('elementos.destroy', $elemento->Id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar {{ $elemento->Name }}?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
