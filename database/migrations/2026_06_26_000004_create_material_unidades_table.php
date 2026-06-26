<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        Schema::create('material_unidades', function (Blueprint $table) {
            $table->increments('idMaterialUnidad');
            $table->integer('cantidad');
            $table->unsignedInteger('idUnidad');
            $table->unsignedBigInteger('codigo');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('idUnidad')
                ->references('idUnidad')
                ->on('unidades')
                ->onDelete('cascade');

            $table->foreign('codigo')
                ->references('codigo')
                ->on('materiales')
                ->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_unidades');
    }
};
