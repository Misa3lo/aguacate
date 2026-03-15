<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPlot extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_plot';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name',
        'Phone',
        'Password',
    ];

    // Esto le dice a Laravel que convierta estos campos en objetos Carbon
    protected $casts = [
        'Created_at' => 'datetime',
        'Updated_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
