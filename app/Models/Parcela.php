<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $table = 'parcela';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'coordenada_gps',
        'direccion',
        'extension_ha',
        'num_arboles'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
