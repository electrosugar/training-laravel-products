<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'contact' => $this->faker->email(),
            'comment' => $this->faker->paragraph(3, 2),
            'creation_date' => $this->faker->date('Y-m-d-h-m-s'),
            'total_price' => $this->faker->randomFloat(2, 1, 10000),
        ];
    }
}
