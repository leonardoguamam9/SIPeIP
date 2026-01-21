<?php

namespace Tests\Unit;

use App\Models\OE;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OETest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_oe()
    {
        $oe = OE::factory()->create([
            'codigoOE' => 'OE-001',
            'nombreOE' => 'Objetivo Estratégico de Prueba',
            'descripcionOE' => 'Descripción de prueba',
            'estadoOE' => 'Activo',
        ]);

        $this->assertDatabaseHas('oes', [
            'codigoOE' => 'OE-001',
            'nombreOE' => 'Objetivo Estratégico de Prueba',
        ]);
    }
}
