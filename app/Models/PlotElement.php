<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlotElement extends Model
{
    protected $table = 'plot_elements';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Plot_id',
        'Element_id',
        'Review_id',
        'Observed_value',
    ];

    public function plot(): BelongsTo {
        return $this->belongsTo(Plot::class, 'Plot_id', 'Id');
    }

    public function element() {
        return $this->belongsTo(Element::class, 'Element_id', 'Id');
    }

    public function review(): BelongsTo {
        return $this->belongsTo(PlotReview::class, 'Review_id', 'Id');
    }
}
