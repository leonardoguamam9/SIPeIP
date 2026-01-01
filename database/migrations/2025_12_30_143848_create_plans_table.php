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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string ('nombrePlan');
            $table->string ('descripcionPlan');
            $table->string ('estadoPlan');
            $table->date ('fechaInicio');
            $table->date ('fechaFin');
            $table->foreignId('entidad_id')
                  ->constrained('entidad')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
