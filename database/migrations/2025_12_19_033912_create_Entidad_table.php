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
        Schema::create('Entidad', function (Blueprint $table) {
            $table->id();
            $table->string ('nombreEntidad');
            $table->string ('tipoEntidad');
            $table->string ('direccionEntidad');
            $table->string ('subSector');
            $table->string ('responsable'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidads');
    }
};
