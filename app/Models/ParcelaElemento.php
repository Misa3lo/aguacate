<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParcelaElemento extends Model
{
    use HasFactory;

    protected $table = 'parcela_elemento';

    public $timestamps = false;

    protected $fillable = [
        'parcela_id',
        'elemento_id',
        'revision_id',
        'valor_observado',
    ];

    public function parcela(): BelongsTo
    {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }

    public function elemento(): BelongsTo
    {
        return $this->belongsTo(Elemento::class, 'elemento_id');
    }

    public function revision(): BelongsTo
    {
        return $this->belongsTo(RevisionParcela::class, 'revision_id');
    }
}