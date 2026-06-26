<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presupuesto extends Model
{
    /**
     * Tabla asociada (Laravel pluraliza "presupuesto" -> "presupuestos").
     */
    protected $table = 'presupuestos';

    /**
     * Clave primaria personalizada (consistente con el resto del equipo:
     * idCategoria, codigo, idUnidad, idMaterialUnidad).
     */
    protected $primaryKey = 'codigoPresupuesto';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'nombrePresupuesto',
        'idUnidad',
    ];

    /**
     * Direccionalidad: Unidad (1) --tiene--> (1..*) Presupuesto.
     * Cada Presupuesto pertenece a una Unidad (rol -unidad).
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    /*
     * Direccionalidad: MaterialUnidad (0..*) --comprado con--> (1) Presupuesto.
     * Un Presupuesto puede tener muchos MaterialUnidad (rol -presupuesto).
     *
     * PENDIENTE DE COORDINAR CON COMPAÑERO 2: la tabla material_unidades aún
     * no tiene la FK 'idPresupuesto'. Habilitar cuando dicha columna exista:
     *
     * public function materialUnidades(): HasMany
     * {
     *     return $this->hasMany(MaterialUnidad::class, 'idPresupuesto', 'codigoPresupuesto');
     * }
     */
}
