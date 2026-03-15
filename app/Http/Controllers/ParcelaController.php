<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plot;
use App\Models\UserPlot;
use App\Models\Locality; // <--- Importa el modelo aquí

class ParcelaController extends Controller
{
    public function index()
    {
        // Cargamos la relación para mostrar el nombre del dueño en la tabla
        $parcelas = Plot::with('userPlot')->get();
        return view('parcelas.index', compact('parcelas'));
    }

    public function create()
    {
        $usuarios = UserPlot::all();
        $localidades = Locality::all(); // <--- Obtén todas las localidades de la base de datos

        // Pásalas a la vista usando compact
        return view('parcelas.create', compact('usuarios', 'localidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'User_plot_id' => 'required|exists:users_plot,Id',
            'Locality_id'  => 'required', // Verifica que tengas registros en la tabla localities
            'Latitude'     => 'required|numeric',
            'Longitude'    => 'required|numeric',
            'Area_ha'      => 'required|numeric|min:0',
            'Tree_count'   => 'required|integer|min:0',
        ]);

        // Al usar $request->all(), Laravel mapea los nombres del HTML con el $fillable
        Plot::create($request->all());

        return redirect()->route('parcelas.index')
            ->with('success', 'Huerto registrado correctamente.');
    }

    public function edit($id)
    {
        $parcela = Plot::findOrFail($id);
        $usuarios = UserPlot::all();
        $localidades = Locality::all(); // <--- También es necesario para la vista de edición

        return view('parcelas.edit', compact('parcela', 'usuarios', 'localidades'));
    }

    public function update(Request $request, $id)
    {
        $parcela = Plot::findOrFail($id);

        $request->validate([
            'User_plot_id' => 'required|exists:users_plot,Id',
            'Locality_id'  => 'required',
            'Latitude'     => 'required|numeric',
            'Longitude'    => 'required|numeric',
            'Area_ha'      => 'required|numeric|min:0',
            'Tree_count'   => 'required|integer|min:0',
        ]);

        $parcela->update($request->all());

        return redirect()->route('parcelas.index')
            ->with('success', 'Información del huerto actualizada.');
    }

    public function destroy($id)
    {
        $parcela = Plot::findOrFail($id);
        $parcela->delete();

        return redirect()->route('parcelas.index')
            ->with('success', 'Huerto eliminado.');
    }
}
