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
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th><i class="fas fa-vial"></i> Nombre del Elemento</th>
                    <th><i class="fas fa-weight-hanging"></i> Unidad de Medida</th>
                    <th style="width: 150px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($elementos as $elemento)
                    <tr>
                        <td><span class="text-muted">#{{ $elemento->id }}</span></td>
                        <td>
                                <span class="fw-bold text-dark" style="font-size: 1.1rem;">
                                    {{ $elemento->nombre }}
                                </span>
                        </td>
                        <td>
                                <span class="badge bg-no-aplicar" style="font-size: 0.9rem;">
                                    {{ $elemento->unidad }}
                                </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('elementos.edit', $elemento->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar nombre o unidad">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('elementos.destroy', $elemento->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar Nutriente"
                                            onclick="return confirm('¿Está seguro de que desea eliminar el elemento {{ $elemento->nombre }}? Esto podría afectar los análisis registrados.')">
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
