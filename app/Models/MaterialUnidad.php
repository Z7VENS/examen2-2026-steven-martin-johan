<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialUnidad extends Model
{
    // Nombre de la tabla
    protected $table = 'material_unidades';

    // Clave primaria de la tabla
    protected $primaryKey = 'idMaterialUnidad';

    // Campos rellenables
    protected $fillable = [
        'cantidad',
        'idUnidad',
        'codigo',
    ];

    /**
     * Relación: un material_unidad pertenece a una Unidad.
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'idUnidad');
    }

    /**
     * Relación: un material_unidad pertenece a un Material.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'codigo', 'codigo');
    }
}
