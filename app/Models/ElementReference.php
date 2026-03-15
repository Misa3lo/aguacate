<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementReference extends Model
{
    protected $table = 'element_references'; // Tu nombre de tabla
    protected $primaryKey = 'Id';

    const CREATED_AT = 'Created_at';
    const UPDATED_AT = 'Updated_at';

    protected $fillable = [
        'Element_id',
        'Reference_value',
        'Deviation_coefficient',
    ];

    protected $casts = [
        'Created_at' => 'datetime',
        'Updated_at' => 'datetime',
        'Reference_value' => 'float',
        'Deviation_coefficient' => 'float',
    ];

    public function element()
    {
        return $this->belongsTo(Element::class, 'Element_id', 'Id');
    }
}
