@extends('layouts.app')

@section('title', 'Crear Nuevo Nutriente')

@section('content')

    <div class="card-form">
        <form action="{{ route('elementos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="Name"><i class="fas fa-tag"></i> Nombre del Nutriente:</label>
                {{-- name="Name" para coincidir con el controlador --}}
                <input type="text" id="Name" name="Name" value="{{ old('Name') }}" placeholder="Ej. Nitrógeno" required>
                @error('Name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Unit"><i class="fas fa-ruler"></i> Unidad de Medida:</label>
                {{-- name="Unit" --}}
                <input type="text" id="Unit" name="Unit" value="{{ old('Unit') }}" placeholder="Ej. % o ppm" required>
                @error('Unit') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar Nutriente</button>
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
