<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    // Nombre de la tabla
    protected $table = 'unidades';

    // Clave primaria de la tabla
    protected $primaryKey = 'idUnidad';

    // Campos rellenables
    protected $fillable = [
        'nombre',
    ];

    /**
     * Relación de una unidad con muchos MaterialUnidad.
     */
    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class, 'idUnidad');
    }
}
