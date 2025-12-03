<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable = ['nombre', 'telefono', 'password'];

    // Relación: Un usuario tiene muchas parcelas
    public function parcelas() {
        return $this->hasMany(Parcela::class, 'usuario_id');
    }
}
