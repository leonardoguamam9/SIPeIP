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
        Schema::create('oes', function (Blueprint $table) {
            $table->id();
             $table->string('codigoOE');
             $table->string('nombreOE');
             $table->string('descripcionOE');
             $table->string('estadoOE')->default('Borrador');

        //Relacion con Entidad 
            $table->foreignId('entidad_id')
              ->constrained('entidad')
              ->onDelete('cascade');
        //Relación con PND 
            $table->foreignId('pdn_id')
              ->constrained('pdns')
              ->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oes');
    }
};
