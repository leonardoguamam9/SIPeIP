<?php

namespace Tests\Unit;

use App\Models\PDN;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PDNTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_pdn()
    {
        $pdn = PDN::factory()->create([
            'codigoPDN' => 'PDN-001',
            'nombrePDN' => 'Plan Nacional de Prueba',
        ]);

        $this->assertDatabaseHas('pdns', [
            'codigoPDN' => 'PDN-001',
            'nombrePDN' => 'Plan Nacional de Prueba',
        ]);
    }
}
