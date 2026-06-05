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
        Schema::create('reporte_maestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('entidad_id')->nullable()->constrained('entidad')->onDelete('set null');
            $table->foreignId('pdn_id')->nullable()->constrained('pdns')->onDelete('set null');
            $table->foreignId('ods_id')->nullable()->constrained('o_d_s')->onDelete('set null');
            $table->foreignId('plan_id')->nullable()->constrained('plans')->onDelete('set null');
            $table->foreignId('meta_id')->nullable()->constrained('metas')->onDelete('set null');
            $table->foreignId('programa_id')->nullable()->constrained('programas')->onDelete('set null');
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_maestros');
    }
};
