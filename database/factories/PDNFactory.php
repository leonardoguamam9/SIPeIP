<?php

namespace Database\Factories;

use App\Models\PDN;
use App\Models\Entidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PDNFactory extends Factory
{
    protected $model = PDN::class;

    public function definition(): array
    {
        return [
            'codigoPDN' => 'PDN-' . $this->faker->unique()->numberBetween(1, 1000),
            'nombrePDN' => $this->faker->sentence(3),
            'descripcionPDN' => $this->faker->paragraph,
            'anio_inicio' => $this->faker->year,
            'anio_fin' => $this->faker->year,
            'horizonte_planificacion' => 'Corto Plazo',
            'fecha_aprobacion' => $this->faker->date(),
            'resolucion_aprobacion' => 'Res-123',
            'entidad_id' => Entidad::factory(),
            'users_id' => User::factory(),
            'responsable_pdn' => $this->faker->name,
            'documentoPDN' => null,
            'url_repositorio' => $this->faker->url,
            'observaciones' => $this->faker->sentence,
            'estadoPDN' => 'Activo',
        ];
    }
}
