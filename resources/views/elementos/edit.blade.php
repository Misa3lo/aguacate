@extends('layouts.app')

@section('title', 'Editar Nutriente: ' . $elemento->nombre)

@section('content')

    <div class="card-form">
        <form action="{{ route('elementos.update', $elemento->Id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="Name">Nombre del Nutriente:</label>
                <input type="text" id="Name" name="Name" value="{{ old('Name', $elemento->Name) }}" required>
                @error('Name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Unit">Unidad de Medida:</label>
                <input type="text" id="Unit" name="Unit" value="{{ old('Unit', $elemento->Unit) }}" required>
                @error('Unit') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Actualizar Nutriente</button>
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
