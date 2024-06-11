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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idCarrito');
            $table->string('direccion');
            $table->string('ciudad', 100);
            $table->string('codigoPostal', 20);
            $table->string('pais', 100);
            $table->foreign('idUsuario')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCarrito')->references('id')->on('carritos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
