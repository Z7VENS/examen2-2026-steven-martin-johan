<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo_presupuesto')->unique();
            $table->string('nombre_presupuesto');

            // Unidad (1) --tiene--> (1..*) Presupuesto : cada Presupuesto pertenece a una Unidad.
            $table->foreignId('unidad_id')
                ->nullable()
                ->constrained('unidades')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
