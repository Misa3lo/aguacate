@extends('layouts.app')

@section('title', 'Editar Valor de Referencia ID: ' . $referencia->Id)

@section('content')

    <div class="card-form">
        {{-- Usamos $referencia->Id --}}
        <form action="{{ route('referencias.update', $referencia->Id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="Element_id"><i class="fas fa-flask"></i> Nutriente al que Aplica:</label>
                <select id="Element_id" name="Element_id" required>
                    <option value="">-- Seleccione un Nutriente --</option>
                    @foreach ($elementos as $elemento)
                        <option value="{{ $elemento->Id }}"
                            {{ old('Element_id', $referencia->Element_id) == $elemento->Id ? 'selected' : '' }}>
                            {{ $elemento->Name }} (Unidad: {{ $elemento->Unit }})
                        </option>
                    @endforeach
                </select>
                @error('Element_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="Reference_value"><i class="fas fa-ruler-horizontal"></i> Valor de Referencia (Ideal):</label>
                <input type="number" step="0.0001" id="Reference_value" name="Reference_value"
                       value="{{ old('Reference_value', $referencia->Reference_value) }}" required>
                @error('Reference_value')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="Deviation_coefficient"><i class="fas fa-percent"></i> Coeficiente de Variación:</label>
                <input type="number" step="0.0001" id="Deviation_coefficient" name="Deviation_coefficient"
                       value="{{ old('Deviation_coefficient', $referencia->Deviation_coefficient) }}" required>
                @error('Deviation_coefficient')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Información de auditoría para mantener la disposición visual --}}
            <div class="alert alert-light mt-3" style="border: 1px dashed #ccc; font-size: 0.85em;">
                <i class="fas fa-info-circle"></i> Registrado originalmente:
                <strong>{{ $referencia->Created_at ? $referencia->Created_at->format('d/m/Y H:i') : 'N/A' }}</strong>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Referencia</button>
                <a href="{{ route('referencias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
