@extends('layouts.app')

@section('title', 'Crear Nuevo Nutriente')

@section('content')

    <div class="card-form">
        <form action="{{ route('elementos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre"><i class="fas fa-tag"></i> Nombre del Nutriente:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="unidad"><i class="fas fa-ruler"></i> Unidad de Medida (Ej. ppm, %):</label>
                <input type="text" id="unidad" name="unidad" value="{{ old('unidad') }}" required>
                @error('unidad')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Nutriente</button>
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
