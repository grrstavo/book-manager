<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assunto>
 */
class AssuntoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Descricao' => fake()->unique()->randomElement([
                'Ficção',
                'Não-ficção',
                'Biografia',
                'Fantasia',
                'Romance',
                'Mistério',
                'História',
                'Ciência',
                'Autoajuda',
                'Tecnologia',
            ]),
        ];
    }
}
