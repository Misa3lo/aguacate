<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotElement;
use App\Models\Plot;
use App\Models\Element;
use App\Models\PlotReview;

class ParcelaElementoController extends Controller
{
    public function index() {
        $muestreos = PlotElement::with(['plot', 'element', 'review'])->get();
        // Cambia 'muestreos.index' por 'parcela_elementos.index'
        return view('parcela_elementos.index', compact('muestreos'));
    }

    public function create() {
        $parcelas = Plot::all();
        $elementos = Element::all();
        $revisiones = PlotReview::all();
        // Cambia 'muestreos.create' por 'parcela_elementos.create'
        return view('parcela_elementos.create', compact('parcelas', 'elementos', 'revisiones'));
    }

    public function edit($id) {
        $muestreo = PlotElement::findOrFail($id);
        $parcelas = Plot::all();
        $elementos = Element::all();
        $revisiones = PlotReview::all();
        // Cambia 'muestreos.edit' por 'parcela_elementos.edit'
        return view('parcela_elementos.edit', compact('muestreo', 'parcelas', 'elementos', 'revisiones'));
    }

    public function store(Request $request) {
        $request->validate([
            'Plot_id' => 'required|exists:plots,Id',
            'Element_id' => 'required|exists:elements,Id',
            'Review_id' => 'required|exists:plot_reviews,Id',
            'Observed_value' => 'required|numeric',
        ]);

        PlotElement::create($request->all());
        return redirect()->route('muestreos.index')->with('success', 'Muestra guardada.');
    }

    public function update(Request $request, $id) {
        $muestreo = PlotElement::findOrFail($id);
        $request->validate([
            'Plot_id' => 'required|exists:plots,Id',
            'Element_id' => 'required|exists:elements,Id',
            'Review_id' => 'required|exists:plot_reviews,Id',
            'Observed_value' => 'required|numeric',
        ]);

        $muestreo->update($request->all());
        return redirect()->route('muestreos.index')->with('success', 'Muestra actualizada.');
    }
}
