<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotReview; // Cambiado de RevisionParcela
use App\Models\Plot;       // Cambiado de Parcela

class RevisionParcelaController extends Controller
{
    public function index()
    {
        // Cargamos la relación 'plot' (antes parcela)
        $revisiones = PlotReview::with('plot')->get();
        return view('revisiones.index', compact('revisiones'));
    }

    public function create()
    {
        $parcelas = Plot::all();
        return view('revisiones.create', compact('parcelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validamos contra la tabla 'plots' y el campo 'Id'
            'Plot_id' => 'required|exists:plots,Id',
            'Review_date' => 'required|date',
        ]);

        PlotReview::create([
            'Plot_id' => $request->Plot_id,
            'Review_date' => $request->Review_date,
        ]);

        return redirect()->route('revisiones.index')->with('success', 'Revisión registrada exitosamente.');
    }

    public function edit($id)
    {
        $revision = PlotReview::findOrFail($id);
        $parcelas = Plot::all();
        return view('revisiones.edit', compact('revision', 'parcelas'));
    }

    public function update(Request $request, $id)
    {
        $revision = PlotReview::findOrFail($id);

        $request->validate([
            'Plot_id' => 'required|exists:plots,Id',
            'Review_date' => 'required|date',
        ]);

        $revision->update([
            'Plot_id' => $request->Plot_id,
            'Review_date' => $request->Review_date,
        ]);

        return redirect()->route('revisiones.index')->with('success', 'Revisión actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $revision = PlotReview::findOrFail($id);
        $revision->delete();
        return redirect()->route('revisiones.index')->with('success', 'Revisión eliminada correctamente.');
    }
}
