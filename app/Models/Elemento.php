<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    use HasFactory;

    protected $table = 'elemento';
    public $timestamps = false; // Tu tabla no tiene created_at/updated_at

    protected $fillable = ['nombre', 'unidad'];
}
