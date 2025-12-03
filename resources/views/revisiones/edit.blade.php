@extends('layouts.app')

@section('title', 'Editar Revisión ID: ' . $revision->id)

@section('content')

    <div class="card-form">
        <form action="{{ route('revisiones.update', $revision->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="parcela_id"><i class="fas fa-map-marked-alt"></i> Parcela a Revisar:</label>
                <select id="parcela_id" name="parcela_id" required>
                    <option value="">-- Seleccione una Parcela --</option>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->id }}"
                            {{ old('parcela_id', $revision->parcela_id) == $parcela->id ? 'selected' : '' }}>
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
                <input type="date" id="fecha_revision" name="fecha_revision"
                       value="{{ old('fecha_revision', \Carbon\Carbon::parse($revision->fecha_revision)->format('Y-m-d')) }}"
                       required>
                @error('fecha_revision')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Revisión</button>
                <a href="{{ route('revisiones.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
