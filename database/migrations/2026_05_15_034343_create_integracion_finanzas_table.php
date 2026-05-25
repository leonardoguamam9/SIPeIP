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
        Schema::create('integracion_finanzas', function (Blueprint $table) {
            $table->id();
            $table->string('codigoIntegracion');
            $table->string('entidad');
            $table->decimal('montoPresupuesto', 12, 2);
            $table->date('fechaEnvio');
            $table->string('estado')->default('Pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integracion_finanzas');
        
    }
};
