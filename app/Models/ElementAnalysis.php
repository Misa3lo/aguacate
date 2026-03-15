<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElementAnalysis extends Model
{
    // Nombre exacto de la tabla en el SQL
    protected $table = 'element_analysis';

    // Llave primaria según SQL
    protected $primaryKey = 'id';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'plot_element_id',
        'ind_kenworthy',
        'sufficiency_level',
        'application_need',
    ];

    /**
     * Relación con el dato de origen (Muestreo/PlotElement)
     */
    public function plotElement() {
        return $this->belongsTo(PlotElement::class, 'Plot_element_id', 'Id');
    }
}
