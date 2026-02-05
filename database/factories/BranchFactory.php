<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'code' => $this->faker->unique()->bothify('BR###'),
            'address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'manager_name' => $this->faker->name,
            'assistant_1_name' => $this->faker->name,
            'assistant_2_name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'manager_phone' => $this->faker->phoneNumber,
            'cost' => $this->faker->numberBetween(1000000, 5000000),
        ];
    }
}
