<?php

namespace Database\Factories\Catalogo;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalogo\Aduanas>
 */
class AduanasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'idAduana' => $this->faker->unique()->numberBetween(1000, 9999),
            'aduanaAlias' => $this->faker->unique()->word(),
            'aduanaEstado' => $this->faker->randomElement(['A', 'I']),
        ];
    }
}
