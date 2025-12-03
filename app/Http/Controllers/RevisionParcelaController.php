<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RevisionParcela;
use App\Models\Parcela; // Necesario para seleccionar la parcela

class RevisionParcelaController extends Controller
{
    public function index()
    {
        $revisiones = RevisionParcela::with('parcela')->get();
        return view('revisiones.index', compact('revisiones'));
    }

    public function create()
    {
        $parcelas = Parcela::all();
        return view('revisiones.create', compact('parcelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parcela_id' => 'required|exists:parcela,id',
            'fecha_revision' => 'required|date',
        ]);

        RevisionParcela::create($request->all());
        return redirect()->route('revisiones.index')->with('success', 'Revisión registrada exitosamente.');
    }

    public function edit(RevisionParcela $revision)
    {
        $parcelas = Parcela::all();
        return view('revisiones.edit', compact('revision', 'parcelas'));
    }

    public function update(Request $request, RevisionParcela $revision)
    {
        $request->validate([
            'parcela_id' => 'required|exists:parcela,id',
            'fecha_revision' => 'required|date',
        ]);

        $revision->update($request->all());
        return redirect()->route('revisiones.index')->with('success', 'Revisión actualizada exitosamente.');
    }

    public function destroy(RevisionParcela $revision)
    {
        $revision->delete();
        return redirect()->route('revisiones.index')->with('success', 'Revisión eliminada correctamente.');
    }
}
