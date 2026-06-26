<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    /**
     * Tabla asociada (se fija explícitamente porque Laravel pluralizaría
     * "requisicion" como "requisicions" en lugar de "requisiciones").
     */
    protected $table = 'requisiciones';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'fecha',
        'estado',
    ];

    /**
     * Casts de atributos.
     */
    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
        ];
    }

    /*
     * Relaciones del modelo de dominio (Figura 1) hacia clases que NO forman
     * parte de la tabla de clases a implementar en este examen. Se documentan
     * para respetar la direccionalidad; se habilitan cuando dichas clases
     * existan en el proyecto:
     *
     * // Requisicion (1) --tiene--> (0..*) ItemRequisicion
     * public function items(): HasMany
     * {
     *     return $this->hasMany(ItemRequisicion::class);
     * }
     *
     * // Requisicion (0..1) --pertenece a--> (1) Usuario
     * public function usuario(): BelongsTo
     * {
     *     return $this->belongsTo(Usuario::class);
     * }
     */
}
