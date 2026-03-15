<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends Model
{
    // Nombre de la tabla en el SQL
    protected $table = 'elements';

    // Llave primaria según tu SQL
    protected $primaryKey = 'Id';

    // Campos en inglés
    protected $fillable = [
        'Name',
        'Unit',
    ];

    /**
     * Definimos las constantes con el nombre exacto de la base de datos.
     * Laravel las usará automáticamente para las marcas de tiempo.
     */
    const CREATED_AT = 'Created_at';
    const UPDATED_AT = 'Updated_at';

    /**
     * Aseguramos que Eloquent trate estas columnas como objetos Carbon.
     */
    protected $casts = [
        'Created_at' => 'datetime',
        'Updated_at' => 'datetime',
        'Deleted_at' => 'datetime',
    ];

    // Relación con los valores de referencia
    public function references(): HasMany
    {
        return $this->hasMany(ElementReference::class, 'Element_id', 'Id');
    }
}
