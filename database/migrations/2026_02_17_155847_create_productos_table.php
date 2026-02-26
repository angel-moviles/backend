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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('lote', 50)->unique();
            $table->string('nombre');

            $table->date('fecha_produccion');
            $table->date('fecha_caducidad');

            // 💰 nombres reales
            $table->decimal('costo', 10, 2);
            $table->decimal('precio_venta', 10, 2);

            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(0);

            $table->boolean('activo')->default(true);

            // FK laboratorio
            $table->foreignId('id_laboratorio')
                ->constrained('laboratorios', 'id_laboratorio')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // FK tipo producto
            $table->foreignId('id_tipo_producto')
                ->constrained('tipo_productos', 'id_tipo_producto')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // FK presentacion
            $table->foreignId('id_presentacion')
                ->constrained('presentacions', 'id_presentacion')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // 🔥 FIX AQUÍ
            $table->foreignId('id_proveedor')
                ->constrained('proveedors', 'id_proveedor') // ✅ CORRECTO
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
        Schema::dropIfExists('productos');
    }
};
