<?php

namespace Tests\Unit;

use App\Models\Plan;
use App\Models\Entidad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_plan()
    {
        // Crear una Entidad para la relación
        $entidad = Entidad::factory()->create();

        // Crear un Plan asociado a la Entidad
        $plan = Plan::create([
            'nombrePlan' => 'Plan de Prueba',
            'descripcionPlan' => 'Descripción del plan de prueba',
            'estadoPlan' => 'Activo',
            'fechaInicio' => now()->format('Y-m-d'),
            'fechaFin' => now()->addMonth()->format('Y-m-d'),
            'entidad_id' => $entidad->id,
        ]);

        // Verificar que se haya guardado en la base de datos
        $this->assertDatabaseHas('plans', [
            'nombrePlan' => 'Plan de Prueba',
            'entidad_id' => $entidad->id,
        ]);

        // Verificar relación con Entidad
        $this->assertEquals($entidad->id, $plan->entidad->id);
    }
}
