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
        Schema::create('alergeno_recetas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idReceta');
            $table->unsignedBigInteger('idAlergeno');
            $table->foreign('idReceta')->references('id')->on('recetas');
            $table->foreign('idAlergeno')->references('id')->on('alergenos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alergeno_recetas');
    }
};
