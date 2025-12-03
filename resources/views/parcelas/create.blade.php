@extends('layouts.app')

@section('title', 'Registrar Nueva Parcela')

@section('content')

    <div class="card-form">
        <form action="{{ route('parcelas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="usuario_id"><i class="fas fa-users"></i> Dueño de la Parcela:</label>
                <select id="usuario_id" name="usuario_id" required>
                    <option value="">-- Seleccione un Dueño --</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }} (Tel: {{ $usuario->telefono }})
                        </option>
                    @endforeach
                </select>
                @error('usuario_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="direccion"><i class="fas fa-road"></i> Dirección / Ubicación:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                @error('direccion')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="coordenada_gps"><i class="fas fa-compass"></i> Coordenadas GPS:</label>
                <input type="text" id="coordenada_gps" name="coordenada_gps" value="{{ old('coordenada_gps') }}" required>
                @error('coordenada_gps')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="extension_ha"><i class="fas fa-chart-area"></i> Extensión (Hectáreas - ha):</label>
                <input type="number" step="0.01" id="extension_ha" name="extension_ha" value="{{ old('extension_ha') }}" required>
                @error('extension_ha')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="num_arboles"><i class="fas fa-tree"></i> Número Estimado de Árboles (Opcional):</label>
                <input type="number" id="num_arboles" name="num_arboles" value="{{ old('num_arboles') }}">
                @error('num_arboles')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Parcela</button>
                <a href="{{ route('parcelas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
