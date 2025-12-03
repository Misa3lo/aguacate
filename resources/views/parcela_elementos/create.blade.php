@extends('layouts.app')

@section('title', 'Ingresar Nueva Muestra de Nutriente')

@section('content')

    <div class="card-form">
        <form action="{{ route('muestreos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="parcela_id"><i class="fas fa-map-marked-alt"></i> Parcela:</label>
                <select id="parcela_id" name="parcela_id" required>
                    <option value="">-- Seleccione una Parcela --</option>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->id }}" {{ old('parcela_id') == $parcela->id ? 'selected' : '' }}>
                            ID: {{ $parcela->id }} - {{ $parcela->direccion }}
                        </option>
                    @endforeach
                </select>
                @error('parcela_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="elemento_id"><i class="fas fa-flask"></i> Nutriente (Elemento):</label>
                <select id="elemento_id" name="elemento_id" required>
                    <option value="">-- Seleccione un Nutriente --</option>
                    @foreach ($elementos as $elemento)
                        <option value="{{ $elemento->id }}" {{ old('elemento_id') == $elemento->id ? 'selected' : '' }}>
                            {{ $elemento->nombre }} ({{ $elemento->unidad }})
                        </option>
                    @endforeach
                </select>
                @error('elemento_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="revision_id"><i class="fas fa-calendar-check"></i> Revisión (Fecha de toma de muestra):</label>
                <select id="revision_id" name="revision_id" required>
                    <option value="">-- Seleccione la Revisión --</option>
                    @foreach ($revisiones as $revision)
                        <option value="{{ $revision->id }}" {{ old('revision_id') == $revision->id ? 'selected' : '' }}>
                            ID: {{ $revision->id }} - {{ \Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y') }} (Parcela ID: {{ $revision->parcela_id }})
                        </option>
                    @endforeach
                </select>
                @error('revision_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="valor_observado"><i class="fas fa-chart-bar"></i> Valor Observado (Medición real):</label>
                <input type="number" step="0.0001" id="valor_observado" name="valor_observado" value="{{ old('valor_observado') }}" required>
                @error('valor_observado')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Muestra</button>
                <a href="{{ route('muestreos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
