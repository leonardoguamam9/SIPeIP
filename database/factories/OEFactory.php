<?php

namespace Database\Factories;

use App\Models\OE;
use App\Models\Entidad;
use App\Models\PDN;
use Illuminate\Database\Eloquent\Factories\Factory;

class OEFactory extends Factory
{
    protected $model = OE::class;

    public function definition(): array
    {
        return [
            'codigoOE' => 'OE-' . $this->faker->unique()->numberBetween(1, 1000),
            'nombreOE' => $this->faker->sentence(3),
            'descripcionOE' => $this->faker->paragraph,
            'estadoOE' => 'Activo',
            'entidad_id' => Entidad::factory(),
            'pdn_id' => PDN::factory(),
        ];
    }
}
