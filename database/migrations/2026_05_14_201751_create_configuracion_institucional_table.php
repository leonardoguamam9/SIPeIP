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
        Schema::create('configuracion_institucional', function (Blueprint $table) {
            $table->id();
            $table->string('nombreInstitucion');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo');
            $table->string('periodoFiscal');
            $table->string('responsable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_institucional');
    }
};
