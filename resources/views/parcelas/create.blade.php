@extends('layouts.app')

@section('title', 'Registrar Nueva Parcela')

@section('content')

    <div class="card-form">
        <form action="{{ route('parcelas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="User_plot_id"><i class="fas fa-users"></i> Dueño de la Parcela:</label>
                <select id="User_plot_id" name="User_plot_id" required>
                    <option value="">-- Seleccione un Dueño --</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->Id }}" {{ old('User_plot_id') == $usuario->Id ? 'selected' : '' }}>
                            {{ $usuario->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Locality_id"><i class="fas fa-map-marker-alt"></i> Localidad:</label>
                <select id="Locality_id" name="Locality_id" required>
                    <option value="">-- Seleccione Ubicación --</option>
                    @foreach ($localidades as $localidad)
                        <option value="{{ $localidad->Id }}" {{ old('Locality_id') == $localidad->Id ? 'selected' : '' }}>
                            {{ $localidad->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="Latitude">Latitud:</label>
                    <input type="number" step="any" name="Latitude" id="Latitude" value="{{ old('Latitude') }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="Longitude">Longitud:</label>
                    <input type="number" step="any" name="Longitude" id="Longitude" value="{{ old('Longitude') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="Area_ha">Extensión (Hectáreas):</label>
                <input type="number" step="0.01" name="Area_ha" id="Area_ha" value="{{ old('Area_ha') }}" required>
            </div>

            <div class="form-group">
                <label for="Tree_count">Número de Árboles:</label>
                <input type="number" name="Tree_count" id="Tree_count" value="{{ old('Tree_count') }}" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Parcela</button>
                <a href="{{ route('parcelas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
