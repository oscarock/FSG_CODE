<?php

namespace Database\Factories;

use App\Models\Catalogo\Aduanas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aduana>
 */
class AduanaFactory extends Factory
{
    // protected $model = \App\Models\Aduanas::class;
    protected $model = Aduanas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idAduana' => $this->faker->unique()->numberBetween(1000, 9999),
            'aduanaAlias' => $this->faker->unique()->word(),
            'aduanaEstado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
