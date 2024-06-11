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
        Schema::create('alergeno_productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idProducto');
            $table->unsignedBigInteger('idAlergeno');
            $table->foreign('idProducto')->references('id')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idAlergeno')->references('id')->on('alergenos')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alergeno_productos');
    }
};
