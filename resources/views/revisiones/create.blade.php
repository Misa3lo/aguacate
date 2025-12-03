@extends('layouts.app')

@section('title', 'Registrar Nueva Revisión de Parcela')

@section('content')

    <div class="card-form">
        <form action="{{ route('revisiones.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="parcela_id"><i class="fas fa-map-marked-alt"></i> Parcela a Revisar:</label>
                <select id="parcela_id" name="parcela_id" required>
                    <option value="">-- Seleccione una Parcela --</option>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->id }}" {{ old('parcela_id') == $parcela->id ? 'selected' : '' }}>
                            ID: {{ $parcela->id }} - {{ $parcela->direccion }} (Dueño: {{ $parcela->usuario->nombre ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('parcela_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_revision"><i class="fas fa-calendar-alt"></i> Fecha de Revisión:</label>
                <input type="date" id="fecha_revision" name="fecha_revision" value="{{ old('fecha_revision') }}" required>
                @error('fecha_revision')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Revisión</button>
                <a href="{{ route('revisiones.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
