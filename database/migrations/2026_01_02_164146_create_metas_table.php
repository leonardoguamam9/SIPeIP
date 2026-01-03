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
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->string('codigoMeta');
            $table->string('nombreMeta');
            $table->string('descripcionMeta');
            $table->string('estadoMeta')->default('Borrador');
    // Relación con Objetivo Estratégico (OE)
        $table->foreignId('oe_id')
              ->constrained('oes')
              ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
