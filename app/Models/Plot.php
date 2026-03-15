<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plot extends Model
{
    protected $table = 'plots';
    protected $primaryKey = 'Id'; // La 'I' es mayúscula según tu SQL

    protected $fillable = [
        'User_plot_id',
        'Locality_id',
        'Latitude',
        'Longitude',
        'Area_ha',
        'Tree_count',
    ];

    // Relación con el Dueño (Productor)
    public function userPlot(): BelongsTo
    {
        return $this->belongsTo(UserPlot::class, 'User_plot_id', 'Id');
    }

    // Relación con la Localidad (si existe el modelo)
    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class, 'Locality_id', 'Id');
    }
}
