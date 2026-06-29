<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_presupuesto', function (Blueprint $table) {

            $table->id('id_detalle');

            $table->unsignedBigInteger('id_presupuesto');
            $table->unsignedBigInteger('id_material');

            $table->decimal('cantidad', 12, 2);
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('importe', 12, 2);

            $table->timestamps();

            $table->foreign('id_presupuesto')
                ->references('id_presupuesto')
                ->on('presupuestos')
                ->onDelete('cascade');

            $table->foreign('id_material')
                ->references('id_material')
                ->on('materiales');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_presupuesto');
    }
};