<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlotReview extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en SQL
    protected $table = 'plot_reviews';

    // Llave primaria en mayúscula
    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        'Plot_id',
        'Review_date'
    ];

    /**
     * Relación con la Parcela (Plot)
     */
    public function plot(): BelongsTo
    {
        // Apunta al modelo Plot usando la llave foránea Plot_id
        return $this->belongsTo(Plot::class, 'Plot_id', 'Id');
    }

    /**
     * Relación con los muestreos (PlotElements)
     */
    public function plotElements(): HasMany
    {
        return $this->hasMany(PlotElement::class, 'Review_id', 'Id');
    }
}
