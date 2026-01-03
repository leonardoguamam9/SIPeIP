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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->string('codigoIndicador');
            $table->string('nombreIndicador');
            $table->text('descripcionIndicador');
            $table->string('tipoIndicador');
            $table->string('formulaIndicador');
            $table->string('estadoIndicador');
            
            //Relacion con metas 
            $table->unsignedBigInteger('meta_id');

            $table->foreign('meta_id')
                  ->references('id')
                  ->on('metas')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};
