@extends('layouts.app')

@section('title', 'Editar Nutriente: ' . $elemento->nombre)

@section('content')

    <div class="card-form">
        <form action="{{ route('elementos.update', $elemento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre"><i class="fas fa-tag"></i> Nombre del Nutriente:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $elemento->nombre) }}" required>
                @error('nombre')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="unidad"><i class="fas fa-ruler"></i> Unidad de Medida (Ej. ppm, %):</label>
                <input type="text" id="unidad" name="unidad" value="{{ old('unidad', $elemento->unidad) }}" required>
                @error('unidad')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Nutriente</button>
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
