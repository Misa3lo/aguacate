<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Importación crucial

// Cambia 'extends Model' a 'extends Authenticatable'
class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable = ['nombre', 'telefono', 'password'];

    // Ocultar la contraseña al serializar el modelo
    protected $hidden = [
        'password',
    ];

    // Relación: Un usuario tiene muchas parcelas
    public function parcelas() {
        return $this->hasMany(Parcela::class, 'usuario_id');
    }
}
