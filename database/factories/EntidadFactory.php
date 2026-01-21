<?php

namespace Database\Factories;

use App\Models\Entidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntidadFactory extends Factory
{
    // Se asocia la factory al modelo Entidad
    protected $model = Entidad::class;

    /**
     * Define el estado por defecto del modelo.
     */
    public function definition(): array
    {
        return [
            'nombreEntidad'    => $this->faker->company, // Nombre de la entidad
            'tipoEntidad'      => $this->faker->randomElement(['Institucional', 'Privada', 'Mixta']), // Tipo obligatorio
            'direccionEntidad' => $this->faker->address, // Dirección
            'subSector'        => $this->faker->word, // Subsector
            'responsable'      => $this->faker->name, // Responsable de la entidad
        ];
    }
}
