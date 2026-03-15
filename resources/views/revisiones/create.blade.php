@extends('layouts.app')

@section('title', 'Registrar Nueva Revisión')

@section('content')

    <div class="card-form shadow-sm p-4">
        <form action="{{ route('revisiones.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="Plot_id" class="form-label"><i class="fas fa-map-marked-alt"></i> Parcela a Revisar:</label>
                <select id="Plot_id" name="Plot_id" class="form-select @error('Plot_id') is-invalid @enderror" required>
                    <option value="">-- Seleccione una Parcela --</option>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->Id }}" {{ old('Plot_id') == $parcela->Id ? 'selected' : '' }}>
                            ID: {{ $parcela->Id }} - {{ $parcela->Address }}
                        </option>
                    @endforeach
                </select>
                @error('Plot_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-4">
                <label for="Review_date" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Revisión:</label>
                <input type="date" id="Review_date" name="Review_date" class="form-control @error('Review_date') is-invalid @enderror" value="{{ old('Review_date') }}" required>
                @error('Review_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Revisión</button>
                <a href="{{ route('revisiones.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
