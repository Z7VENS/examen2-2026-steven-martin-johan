<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presupuesto extends Model
{
    /**
     * Tabla asociada (Laravel pluraliza "presupuesto" -> "presupuestos").
     */
    protected $table = 'presupuestos';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'codigo_presupuesto',
        'nombre_presupuesto',
        'unidad_id',
    ];

    /**
     * Direccionalidad: Unidad (1) --tiene--> (1..*) Presupuesto.
     * Cada Presupuesto pertenece a una Unidad (rol -unidad).
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    /**
     * Direccionalidad: MaterialUnidad (0..*) --comprado con--> (1) Presupuesto.
     * Un Presupuesto puede tener muchos MaterialUnidad (rol -presupuesto).
     */
    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class);
    }
}
