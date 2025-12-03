<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisElemento extends Model
{
    use HasFactory;

    protected $table = 'analisis_elemento';
    public $timestamps = false;

    protected $fillable = [
        'parcela_elemento_id',
        'ind_kenworthy',
        'nivel_suficiencia', // enum: bajo, normal, alto
        'necesidad_aplicacion' // enum: aplicar, no aplicar
    ];
}
