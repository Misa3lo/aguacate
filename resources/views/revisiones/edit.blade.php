@extends('layouts.app')

@section('title', 'Editar Revisión #' . $revision->Id)

@section('content')

    <div class="card-form shadow-sm p-4">
        <form action="{{ route('revisiones.update', $revision->Id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="Plot_id" class="form-label"><i class="fas fa-map-marked-alt"></i> Parcela a Revisar:</label>
                <select id="Plot_id" name="Plot_id" class="form-select" required>
                    @foreach ($parcelas as $parcela)
                        <option value="{{ $parcela->Id }}" {{ (old('Plot_id', $revision->Plot_id) == $parcela->Id) ? 'selected' : '' }}>
                            ID: {{ $parcela->Id }} - {{ $parcela->Address }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="Review_date" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Revisión:</label>
                <input type="date" id="Review_date" name="Review_date" class="form-control"
                       value="{{ old('Review_date', \Carbon\Carbon::parse($revision->Review_date)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-actions d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Revisión</button>
                <a href="{{ route('revisiones.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
