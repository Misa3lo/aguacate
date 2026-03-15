@extends('layouts.app')

@section('title', 'Crear Valor de Referencia')

@section('content')

    <div class="card-form">
        <form action="{{ route('referencias.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="Element_id"><i class="fas fa-vial"></i> Seleccionar Nutriente:</label>
                <select id="Element_id" name="Element_id" class="form-control" required>
                    <option value="">-- Elija un elemento del catálogo --</option>
                    @foreach ($elementos as $elemento)
                        <option value="{{ $elemento->Id }}" {{ old('Element_id') == $elemento->Id ? 'selected' : '' }}>
                            {{ $elemento->Name }} ({{ $elemento->Unit }})
                        </option>
                    @endforeach
                </select>
                @error('Element_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="row mt-3">
                <div class="col-md-6 form-group">
                    <label for="Reference_value"><i class="fas fa-bullseye"></i> Valor de Referencia (Media):</label>
                    <input type="number" step="0.0001" id="Reference_value" name="Reference_value"
                           value="{{ old('Reference_value') }}" class="form-control" placeholder="0.0000" required>
                    @error('Reference_value') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="Deviation_coefficient"><i class="fas fa-percentage"></i> Coeficiente de Variación:</label>
                    <input type="number" step="0.0001" id="Deviation_coefficient" name="Deviation_coefficient"
                           value="{{ old('Deviation_coefficient') }}" class="form-control" placeholder="0.0000" required>
                    @error('Deviation_coefficient') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Referencia</button>
                <a href="{{ route('referencias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
