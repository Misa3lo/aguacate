<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParcelaElemento;
use App\Models\Parcela;
use App\Models\Elemento;
use App\Models\RevisionParcela;

class ParcelaElementoController extends Controller
{
    public function index()
    {
        // Obtenemos los muestreos, cargando las relaciones para mostrar nombres
        $muestreos = ParcelaElemento::with(['parcela', 'elemento', 'revision'])
            ->get();
        return view('parcela_elementos.index', compact('muestreos'));
    }

    public function create()
    {
        // Necesitamos listas para los selectores
        $parcelas = Parcela::all();
        $elementos = Elemento::all();
        $revisiones = RevisionParcela::all();

        return view('parcela_elementos.create', compact('parcelas', 'elementos', 'revisiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parcela_id' => 'required|exists:parcela,id',
            'elemento_id' => 'required|exists:elemento,id',
            'revision_id' => 'required|exists:revision_parcela,id',
            'valor_observado' => 'required|numeric|min:0',
        ]);

        ParcelaElemento::create($request->all());
        return redirect()->route('muestreos.index')->with('success', 'Muestra de parcela-elemento registrada.');
    }

    // Usamos el nombre que definimos en la ruta 'muestreos'
    public function edit(ParcelaElemento $muestreo)
    {
        $parcelas = Parcela::all();
        $elementos = Elemento::all();
        $revisiones = RevisionParcela::all();

        return view('parcela_elementos.edit', compact('muestreo', 'parcelas', 'elementos', 'revisiones'));
    }

    public function update(Request $request, ParcelaElemento $muestreo)
    {
        $request->validate([
            'parcela_id' => 'required|exists:parcela,id',
            'elemento_id' => 'required|exists:elemento,id',
            'revision_id' => 'required|exists:revision_parcela,id',
            'valor_observado' => 'required|numeric|min:0',
        ]);

        $muestreo->update($request->all());
        return redirect()->route('muestreos.index')->with('success', 'Muestra actualizada.');
    }

    public function destroy(ParcelaElemento $muestreo)
    {
        $muestreo->delete();
        return redirect()->route('muestreos.index')->with('success', 'Muestra eliminada.');
    }
}
