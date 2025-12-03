<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionParcela extends Model
{
    use HasFactory;

    protected $table = 'revision_parcela';
    public $timestamps = false;

    protected $fillable = ['parcela_id', 'fecha_revision'];

    public function parcela() {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }
}
