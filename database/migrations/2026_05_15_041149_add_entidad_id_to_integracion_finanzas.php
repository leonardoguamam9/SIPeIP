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
        Schema::table('integracion_finanzas', function (Blueprint $table) {
            //
        $table->foreignId('entidad_id')
              ->after('codigoIntegracion')
              ->constrained('Entidad')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('integracion_finanzas', function (Blueprint $table) {
            //
        });
    }
};
