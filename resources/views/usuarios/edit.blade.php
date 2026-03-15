@extends('layouts.app')

@section('title', 'Editar Dueño: ' . $usuario->nombre)

@section('content')

    <div class="card-form">
        <{{-- Se usa $usuario->Id para la ruta --}}
        <form action="{{ route('usuarios.update', $usuario->Id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="Name">Nombre Completo:</label>
                <input type="text" id="Name" name="Name" value="{{ old('Name', $usuario->Name) }}" required>
                @error('Name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Phone">Teléfono:</label>
                <input type="text" id="Phone" name="Phone" value="{{ old('Phone', $usuario->Phone) }}" required>
                @error('Phone') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Password">Nueva Contraseña (opcional):</label>
                <input type="password" id="Password" name="Password">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Actualizar Dueño</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
