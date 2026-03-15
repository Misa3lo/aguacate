<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecomendationApplication extends Model
{
    use HasFactory;

    // Tabla según el SQL
    protected $table = 'recommendation_application';

    // Llave primaria (id minúscula en SQL para esta tabla)
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'Analysis_element_id',
        'Nutrient_type',
        'Recommend_quantity',
        'Application_unit',
        'Recommendation_date'
    ];

    /**
     * Relación con el análisis que originó esta recomendación
     */
    public function elementAnalysis(): BelongsTo
    {
        return $this->belongsTo(ElementAnalysis::class, 'Analysis_element_id', 'id');
    }
}
