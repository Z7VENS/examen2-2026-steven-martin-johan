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
            $table->id('codigoPresupuesto');
            $table->string('nombrePresupuesto');

            // Unidad (1) --tiene--> (1..*) Presupuesto : cada Presupuesto pertenece a una Unidad.
            // Tipo unsignedInteger para coincidir con unidades.idUnidad (increments / int).
            $table->unsignedInteger('idUnidad');

            $table->timestamps();

            $table->foreign('idUnidad')
                ->references('idUnidad')
                ->on('unidades')
                ->onDelete('cascade');
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
