<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Entidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        return [
            'nombrePlan'    => $this->faker->sentence(3),
            'descripcionPlan' => $this->faker->paragraph,
            'estadoPlan'    => 'Activo',
            'fechaInicio'   => $this->faker->date(),
            'fechaFin'      => $this->faker->date(),
            'entidad_id'    => Entidad::factory(), // Crea automáticamente una Entidad relacionada
        ];
    }
}
