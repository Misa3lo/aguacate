@extends('layouts.app')

@section('title', 'Crear Valor de Referencia')

@section('content')

    <div class="card-form">
        <form action="{{ route('referencias.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="elemento_id"><i class="fas fa-flask"></i> Nutriente al que Aplica:</label>
                <select id="elemento_id" name="elemento_id" required>
                    <option value="">-- Seleccione un Nutriente --</option>
                    @foreach ($elementos as $elemento)
                        <option value="{{ $elemento->id }}" {{ old('elemento_id') == $elemento->id ? 'selected' : '' }}>
                            {{ $elemento->nombre }} (Unidad: {{ $elemento->unidad }})
                        </option>
                    @endforeach
                </select>
                @error('elemento_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="valor_referencia"><i class="fas fa-ruler-horizontal"></i> Valor de Referencia (Ideal):</label>
                <input type="number" step="0.0001" id="valor_referencia" name="valor_referencia" value="{{ old('valor_referencia') }}" required>
                @error('valor_referencia')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="coef_variacion"><i class="fas fa-percent"></i> Coeficiente de Variación:</label>
                <input type="number" step="0.0001" id="coef_variacion" name="coef_variacion" value="{{ old('coef_variacion') }}" required>
                @error('coef_variacion')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Referencia</button>
                <a href="{{ route('referencias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
