@extends('layouts.app')

@section('title', 'Editar Parcela ID: ' . $parcela->Id)

@section('content')

    <div class="card-form">
        <form action="{{ route('parcelas.update', $parcela->Id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Dueño:</label>
                <select name="User_plot_id" required>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->Id }}" {{ $parcela->User_plot_id == $usuario->Id ? 'selected' : '' }}>
                            {{ $usuario->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Localidad:</label>
                <select name="Locality_id" required>
                    @foreach ($localidades as $localidad)
                        <option value="{{ $localidad->Id }}" {{ $parcela->Locality_id == $localidad->Id ? 'selected' : '' }}>
                            {{ $localidad->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Latitud:</label>
                    <input type="number" step="any" name="Latitude" value="{{ old('Latitude', $parcela->Latitude) }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Longitud:</label>
                    <input type="number" step="any" name="Longitude" value="{{ old('Longitude', $parcela->Longitude) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Extensión (ha):</label>
                <input type="number" step="0.01" name="Area_ha" value="{{ old('Area_ha', $parcela->Area_ha) }}" required>
            </div>

            <div class="form-group">
                <label>Árboles:</label>
                <input type="number" name="Tree_count" value="{{ old('Tree_count', $parcela->Tree_count) }}" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar</button>
                <a href="{{ route('parcelas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
