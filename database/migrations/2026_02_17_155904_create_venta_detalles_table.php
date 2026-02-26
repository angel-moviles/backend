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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id('id_venta_detalle');

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);

            // FK venta
            $table->foreignId('id_venta')
                ->constrained('ventas', 'id_venta')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // FK producto
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
