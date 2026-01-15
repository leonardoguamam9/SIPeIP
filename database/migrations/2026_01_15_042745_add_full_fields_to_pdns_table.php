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
        Schema::table('pdns', function (Blueprint $table) {
            //
            // Vigencia
        $table->year('anio_inicio')->nullable()->after('descripcionPDN');
        $table->year('anio_fin')->nullable()->after('anio_inicio');
        $table->string('horizonte_planificacion')->nullable();

        // Estado y aprobación
        $table->date('fecha_aprobacion')->nullable();
        $table->string('resolucion_aprobacion')->nullable();

        // Responsables
        $table->foreignId('entidad_id')
              ->nullable()
              ->constrained('entidad')
              ->onDelete('cascade');

        $table->foreignId('users_id')
              ->nullable()
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('responsable_pdn')->nullable();

        // Documentos
        $table->string('documentoPDN')->nullable();
        $table->string('url_repositorio')->nullable();

        // Observaciones
        $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pdns', function (Blueprint $table) {
            //
            $table->dropForeign(['entidad_id']);
            $table->dropForeign(['users_id']);
            $table->dropColumn([
            'anio_inicio',
            'anio_fin',
            'horizonte_planificacion',
            'fecha_aprobacion',
            'resolucion_aprobacion',
            'entidad_id',
            'users_id',
            'responsable_pdn',
            'documentoPDN',
            'url_repositorio',
            'observaciones'
        ]);
        });
    }
};
