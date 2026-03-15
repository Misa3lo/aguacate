@extends('layouts.app')

@section('title', 'Editar Muestra ID: ' . $muestreo->Id)

@section('content')

    <div class="card-form">
        <form action="{{ route('muestreos.update', $muestreo->Id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- 1. Selección de Parcela --}}
            <div class="form-group">
                <label for="Plot_id"><i class="fas fa-map-marked-alt"></i> Parcela:</label>
                <select id="Plot_id" name="Plot_id" required>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->Id }}"
                            {{ old('Plot_id', $muestreo->Plot_id) == $parcela->Id ? 'selected' : '' }}>
                            ID: {{ $parcela->Id }} - Árboles: {{ $parcela->Tree_count }} (Lat: {{ $parcela->Latitude }})
                        </option>
                    @endforeach
                </select>
                @error('Plot_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2. Selección de Nutriente (Elemento) --}}
            <div class="form-group">
                <label for="Element_id"><i class="fas fa-flask"></i> Nutriente (Elemento):</label>
                <select id="Element_id" name="Element_id" required>
                    @foreach ($elementos as $elemento)
                        <option value="{{ $elemento->Id }}"
                            {{ old('Element_id', $muestreo->Element_id) == $elemento->Id ? 'selected' : '' }}>
                            {{ $elemento->Name }} ({{ $elemento->Unit }})
                        </option>
                    @endforeach
                </select>
                @error('Element_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 3. Selección de Revisión --}}
            <div class="form-group">
                <label for="Review_id"><i class="fas fa-calendar-check"></i> Fecha de Revisión:</label>
                <select id="Review_id" name="Review_id" required>
                    @foreach ($revisiones as $revision)
                        <option value="{{ $revision->Id }}"
                            {{ old('Review_id', $muestreo->Review_id) == $revision->Id ? 'selected' : '' }}>
                            Revisión #{{ $revision->Id }} - {{ \Carbon\Carbon::parse($revision->Review_date)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
                @error('Review_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 4. Valor Observado --}}
            <div class="form-group">
                <label for="Observed_value"><i class="fas fa-vial"></i> Valor Observado (Medición):</label>
                <input type="number" step="0.0001" id="Observed_value" name="Observed_value"
                       value="{{ old('Observed_value', $muestreo->Observed_value) }}" required>
                @error('Observed_value')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Muestra</button>
                <a href="{{ route('muestreos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
