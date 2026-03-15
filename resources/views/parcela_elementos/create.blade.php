@extends('layouts.app')

@section('content')
    <div class="card-form">
        <form action="{{ route('muestreos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Parcela (Huerto):</label>
                <select name="Plot_id" required>
                    @foreach($parcelas as $p)
                        <option value="{{ $p->Id }}">ID: {{ $p->Id }} - Árboles: {{ $p->Tree_count }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nutriente:</label>
                <select name="Element_id" required>
                    @foreach($elementos as $e)
                        <option value="{{ $e->Id }}">{{ $e->Name }} ({{ $e->Unit }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Review_id"><i class="fas fa-calendar-check"></i> Revisión Asociada:</label>

                @if($revisiones->isEmpty())
                    <div class="alert-info-mini" style="background: rgba(255,193,7,0.1); border: 1px dashed #ffc107; padding: 10px; border-radius: 8px;">
                        <p style="color: #856404; font-size: 0.9em; margin: 0;">
                            <i class="fas fa-exclamation-triangle"></i> No hay revisiones registradas para este huerto.
                            <a href="{{ route('revisiones.create') }}" style="font-weight: bold; text-decoration: underline;">Crear una revisión ahora</a>
                        </p>
                    </div>
                    {{-- Input oculto para evitar errores de envío si es necesario, o simplemente deshabilitar el botón --}}
                @else
                    <select id="Review_id" name="Review_id" required>
                        <option value="">-- Seleccione la Fecha de Revisión --</option>
                        @foreach ($revisiones as $r)
                            <option value="{{ $r->Id }}" {{ old('Review_id') == $r->Id ? 'selected' : '' }}>
                                Revisión #{{ $r->Id }} - {{ $r->Review_date }} (Huerto: {{ $r->Plot_id }})
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="form-group">
                <label>Valor Observado (Laboratorio):</label>
                <input type="number" step="0.0001" name="Observed_value" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar Muestra</button>
                <a href="{{ route('muestreos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
