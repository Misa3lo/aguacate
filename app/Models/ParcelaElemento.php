<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelaElemento extends Model
{
    use HasFactory;

    protected $table = 'parcela_elemento';
    public $timestamps = false;

    protected $fillable = [
        'parcela_id',
        'elemento_id',
        'revision_id',
        'valor_observado'
    ];
}
