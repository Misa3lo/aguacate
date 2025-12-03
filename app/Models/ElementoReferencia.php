<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementoReferencia extends Model
{
    use HasFactory;

    protected $table = 'elemento_referencia';
    public $timestamps = false;

    protected $fillable = ['elemento_id', 'valor_referencia', 'coef_variacion'];

    public function elemento() {
        return $this->belongsTo(Elemento::class, 'elemento_id');
    }
}
