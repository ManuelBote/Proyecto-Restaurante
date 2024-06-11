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
        Schema::create('detalle_carritos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCarrito');
            $table->unsignedBigInteger('idProducto');
            $table->integer('cantidad');
            $table->foreign('idCarrito')->references('id')->on('carritos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idProducto')->references('id')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_carritos');
    }
};
