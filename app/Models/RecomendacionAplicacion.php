<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendacionAplicacion extends Model
{
    use HasFactory;

    protected $table = 'recomendacion_aplicacion';
    public $timestamps = false;

    protected $fillable = [
        'analisis_elemento_id',
        'tipo_nutriente',
        'cantidad_recomendada',
        'unidad_aplicacion',
        'fecha_recomendacion'
    ];
}
